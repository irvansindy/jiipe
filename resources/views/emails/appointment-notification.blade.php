<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Appointment Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 700px; margin: 0 auto; padding: 20px; }
        .header { background: #1976d2; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .section { margin: 20px 0; padding: 15px; background: white; border-left: 4px solid #1976d2; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .label { font-weight: bold; width: 35%; color: #555; }
        h3 { color: #1976d2; margin-top: 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔔 New Appointment Submission</h1>
        </div>

        <div class="content">
            <p><strong>A new appointment request has been submitted.</strong></p>

            <div class="section">
                <h3>Basic Information</h3>
                <table>
                    <tr>
                        <td class="label">Name:</td>
                        <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Email:</td>
                        <td><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
                    </tr>
                    <tr>
                        <td class="label">Phone:</td>
                        <td>{{ $data['phone_number'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Company:</td>
                        <td>{{ $data['company_name'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Country Origin:</td>
                        <td>{{ $data['country_origin'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h3>Project Details</h3>
                <table>
                    <tr>
                        <td class="label">Reason:</td>
                        <td>{{ $data['reason'] }}{{ $data['reason_other'] ? ' - ' . $data['reason_other'] : '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Industry:</td>
                        <td>{{ $data['classification'] }}{{ $data['classification_other'] ? ' - ' . $data['classification_other'] : '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Land Plot:</td>
                        <td>{{ $data['land_plot'] }} Ha</td>
                    </tr>
                    <tr>
                        <td class="label">Timeline:</td>
                        <td>{{ $data['timeline'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h3>Energy & Utility Needs</h3>
                <table>
                    <tr>
                        <td class="label">Power:</td>
                        <td>{{ $data['power'] }} MW</td>
                    </tr>
                    <tr>
                        <td class="label">Industrial Water:</td>
                        <td>{{ $data['industrial_water'] }} m³/day</td>
                    </tr>
                    <tr>
                        <td class="label">Natural Gas:</td>
                        <td>{{ $data['natural_gas'] }} MMBTU/annum</td>
                    </tr>
                    <tr>
                        <td class="label">Seaport Throughput:</td>
                        <td>{{ $data['throughput_via_seaport'] }} Tons/Year</td>
                    </tr>
                </table>
            </div>

            <p style="margin-top: 30px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107;">
                <strong>⚠️ Action Required:</strong> Please review and follow up with this appointment request.
            </p>

            <p style="color: #666; font-size: 12px; margin-top: 20px;">
                Submitted on: {{ date('F j, Y, g:i a') }}
            </p>
        </div>
    </div>
</body>
</html>