<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #d32f2f; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .label { font-weight: bold; width: 40%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Appointment Confirmation</h1>
        </div>

        <div class="content">
            <p>Dear {{ $data['first_name'] }} {{ $data['last_name'] }},</p>

            <p>Thank you for submitting your appointment request. We have received your information and will contact you soon.</p>

            <h3>Your Submission Details:</h3>

            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td>{{ $data['email'] }}</td>
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

            <p>Our team will review your request and get back to you within 1-2 business days.</p>

            <p>Best regards,<br>JIIPE Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} JIIPE. All rights reserved.</p>
        </div>
    </div>
</body>
</html>