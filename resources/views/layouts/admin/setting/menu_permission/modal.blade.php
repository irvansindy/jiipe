<div class="modal fade" id="modalMenuPermission" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalMenuPermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalMenuPermissionLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_menu_permission">
                @csrf
                <div class="modal-body">

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    {{-- Menu Name (multilingual) --}}
                    <div class="mb-3">
                        <label class="form-label">Menu Name</label>
                        <ul class="nav nav-tabs" id="menuNameTab" role="tablist">
                            @foreach($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($loop->first) active @endif"
                                            id="tab-menu-name-{{ $locale }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#menu-name-{{ $locale }}"
                                            type="button" role="tab"
                                            aria-controls="menu-name-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ strtoupper($locale) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content border border-top-0 p-3">
                            @foreach($locales as $locale => $properties)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="menu-name-{{ $locale }}" role="tabpanel" aria-labelledby="tab-menu-name-{{ $locale }}">
                                    <input type="text" class="form-control" name="menu_name[{{ $locale }}]" placeholder="Menu Name ({{ strtoupper($locale) }})" required>
                                    <span class="text-danger" id="message_menu_name_{{ $locale }}"></span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Menu Icon (biasa) --}}
                    <div class="mb-3">
                        <label for="menu_icon" class="form-label">Menu Icon</label><br>
                        <input type="text" class="form-control" id="menu_icon" name="menu_icon" required>
                        <span class="text-danger" id="message_menu_icon"></span>
                    </div>

                    {{-- Menu Side (radio) --}}
                    <div class="mb-3">
                        <label class="form-label">For Side ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="menu_type" id="menu_type_1" value="admin_side">
                            <label class="form-check-label" for="menu_type_1">Admin Side</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="menu_type" id="menu_type_2" value="client_side">
                            <label class="form-check-label" for="menu_type_2">User Side</label>
                        </div>
                        <br>
                        <span class="text-danger" id="message_menu_type"></span>
                    </div>

                    {{-- Menu Type (radio) --}}
                    <div class="mb-3 parent_child_menu_section">
                        <label class="form-label">Parent/Child ?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input parent_child_menu" type="radio" name="parent_child_menu" id="parent_menu_1" value="parent_menu">
                            <label class="form-check-label" for="parent_menu_1">Parent Menu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="parent_child_menu" id="parent_menu_2" value="child_menu">
                            <label class="form-check-label" for="parent_menu_2">Child Menu</label>
                        </div>
                        <br>
                        <span class="text-danger" id="message_parent_child_menu"></span>
                    </div>

                    {{-- Parent Menu dropdown --}}
                    <div class="mb-3" id="parent_menu"></div>

                </div>
                <div class="modal-footer" id="button_action_menu">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
