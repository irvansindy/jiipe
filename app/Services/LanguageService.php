<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class LanguageService
{
    /**
     * Config file path
     */
    private $configPath;

    public function __construct()
    {
        $this->configPath = config_path('laravellocalization.php');
    }

    /**
     * Get all languages
     */
    public function getAllLanguages()
    {
        return Language::orderBy('locale', 'asc')->get();
    }

    /**
     * Get language by ID
     */
    public function getLanguageById(int $id)
    {
        return Language::findOrFail($id);
    }

    /**
     * Create new language
     */
    public function createLanguage(array $data)
    {
        DB::beginTransaction();

        try {
            // Create language in database
            $language = Language::create([
                'locale' => $data['locale'],
                'name' => $data['name'],
                'native' => $data['native'],
                'regional' => $data['regional'] ?? '',
                'script' => $data['script'] ?? 'Latn',
            ]);

            // Update config file
            $this->updateConfigFile();

            DB::commit();

            return $language;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update existing language
     */
    public function updateLanguage(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $language = Language::findOrFail($id);

            $language->update([
                'locale' => $data['locale'],
                'name' => $data['name'],
                'native' => $data['native'],
                'regional' => $data['regional'] ?? '',
                'script' => $data['script'] ?? 'Latn',
            ]);

            // Update config file
            $this->updateConfigFile();

            DB::commit();

            return $language;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete language
     */
    public function deleteLanguage(int $id)
    {
        DB::beginTransaction();

        try {
            $language = Language::findOrFail($id);

            // Prevent deleting default language (id)
            if ($language->locale === 'id') {
                throw new Exception('Cannot delete default language (Indonesian)');
            }

            $language->delete();

            // Update config file
            $this->updateConfigFile();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update laravellocalization.php config file
     * Uses var_export for proper Unicode handling
     */
    private function updateConfigFile()
    {
        try {
            // Get all languages from database
            $languages = Language::orderBy('locale', 'asc')->get();

            // Build supportedLocales array
            $supportedLocales = [];
            foreach ($languages as $lang) {
                $supportedLocales[$lang->locale] = [
                    'name' => $lang->name,
                    'script' => $lang->script,
                    'native' => $lang->native,
                    'regional' => $lang->regional,
                ];
            }

            // Read current config file
            if (!File::exists($this->configPath)) {
                throw new Exception('Config file not found: ' . $this->configPath);
            }

            $configContent = File::get($this->configPath);

            // Build new supportedLocales string with proper escaping
            $newLocalesString = $this->buildLocalesString($supportedLocales);

            // Replace supportedLocales in config using regex
            // This pattern matches the entire supportedLocales array including comments
            $pattern = "/'supportedLocales'\s*=>\s*\[.*?\n\s*\]/s";
            $replacement = "'supportedLocales' => [\n{$newLocalesString}    ]";

            $newConfigContent = preg_replace($pattern, $replacement, $configContent);

            if ($newConfigContent === null) {
                throw new Exception('Failed to update config file - regex error');
            }

            // Backup original config before writing
            $backupPath = $this->configPath . '.backup';
            if (File::exists($this->configPath)) {
                File::copy($this->configPath, $backupPath);
            }

            // Write back to file
            File::put($this->configPath, $newConfigContent);

            // Clear config cache
            \Artisan::call('config:clear');

            return true;
        } catch (Exception $e) {
            // Restore from backup if exists
            $backupPath = $this->configPath . '.backup';
            if (File::exists($backupPath)) {
                File::copy($backupPath, $this->configPath);
            }

            throw new Exception('Failed to update config file: ' . $e->getMessage());
        }
    }

    /**
     * Build supportedLocales string for config file
     * Uses var_export for proper Unicode character handling
     */
    private function buildLocalesString(array $supportedLocales)
    {
        $lines = [];

        foreach ($supportedLocales as $locale => $config) {
            $name = $config['name'];
            $script = $config['script'];
            $native = $config['native'];
            $regional = $config['regional'];

            // Use var_export for proper escaping of Unicode and special characters
            // This ensures Japanese, Chinese, Korean, Arabic, etc. are properly handled
            $line = sprintf(
                "        %s => ['name' => %s, 'script' => %s, 'native' => %s, 'regional' => %s],",
                var_export($locale, true),
                var_export($name, true),
                var_export($script, true),
                var_export($native, true),
                var_export($regional, true)
            );

            $lines[] = $line;
        }

        return implode("\n", $lines) . "\n";
    }

    /**
     * Sync database with config file
     */
    public function syncFromConfig()
    {
        DB::beginTransaction();

        try {
            // Reload config to get fresh data
            \Artisan::call('config:clear');

            $supportedLocales = config('laravellocalization.supportedLocales');

            if (empty($supportedLocales)) {
                throw new Exception('No locales found in config file');
            }

            foreach ($supportedLocales as $locale => $config) {
                Language::updateOrCreate(
                    ['locale' => $locale],
                    [
                        'name' => $config['name'] ?? '',
                        'native' => $config['native'] ?? '',
                        'regional' => $config['regional'] ?? '',
                        'script' => $config['script'] ?? 'Latn',
                    ]
                );
            }

            // Remove languages not in config
            $configLocales = array_keys($supportedLocales);
            Language::whereNotIn('locale', $configLocales)->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}