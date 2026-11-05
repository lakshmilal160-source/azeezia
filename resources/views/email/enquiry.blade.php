<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Enquiry - Azeezia</title>
</head>
<body style="margin:0;padding:0;background-color:#F5F3EF;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#2D2A26;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#F5F3EF;padding:40px 15px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background-color:#FFFFFF;border-radius:8px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);border:1px solid #E6E1D7;">
                    <!-- Brand Header -->
                    <tr>
                        <td style="background-color:#16281D;padding:32px 40px;text-align:center;">
                            <h1 style="margin:0;color:#FFFFFF;font-size:24px;letter-spacing:0.1em;font-weight:600;text-transform:uppercase;">
                                Azeezia
                            </h1>
                            <p style="margin:6px 0 0 0;color:#C5AB78;font-size:12px;letter-spacing:0.2em;text-transform:uppercase;">
                                Luxury Convention Centre &amp; Organic Farm Resort
                            </p>
                        </td>
                    </tr>

                    <!-- Title Banner -->
                    <tr>
                        <td style="background-color:#FAF7F2;padding:20px 40px;border-bottom:1px solid #EBE5DB;text-align:center;">
                            <span style="display:inline-block;background-color:#6D8B28;color:#FFFFFF;font-size:11px;font-weight:600;letter-spacing:0.15em;text-transform:uppercase;padding:4px 12px;border-radius:20px;">
                                New Event Enquiry
                            </span>
                            <h2 style="margin:12px 0 0 0;color:#16281D;font-size:19px;font-weight:600;">
                                Message from {{ $enquiry->name }}
                            </h2>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:32px 40px;">
                            <p style="margin:0 0 20px 0;font-size:14px;color:#58544C;line-height:1.6;">
                                A new enquiry has been submitted through the Azeezia website contact form. The details are provided below:
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border:1px solid #E6E1D7;border-radius:6px;overflow:hidden;">
                                <tr>
                                    <td width="150" style="background-color:#FAF7F2;padding:12px 16px;border-bottom:1px solid #E6E1D7;font-weight:600;font-size:13px;color:#16281D;">
                                        Customer Name
                                    </td>
                                    <td style="padding:12px 16px;border-bottom:1px solid #E6E1D7;font-size:14px;color:#2D2A26;font-weight:500;">
                                        {{ $enquiry->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FAF7F2;padding:12px 16px;border-bottom:1px solid #E6E1D7;font-weight:600;font-size:13px;color:#16281D;">
                                        Phone Number
                                    </td>
                                    <td style="padding:12px 16px;border-bottom:1px solid #E6E1D7;font-size:14px;color:#2D2A26;">
                                        <a href="tel:{{ $enquiry->phone }}" style="color:#6D8B28;text-decoration:none;font-weight:500;">
                                            {{ $enquiry->phone }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FAF7F2;padding:12px 16px;border-bottom:1px solid #E6E1D7;font-weight:600;font-size:13px;color:#16281D;">
                                        Email Address
                                    </td>
                                    <td style="padding:12px 16px;border-bottom:1px solid #E6E1D7;font-size:14px;color:#2D2A26;">
                                        <a href="mailto:{{ $enquiry->email }}" style="color:#6D8B28;text-decoration:none;">
                                            {{ $enquiry->email ?: 'N/A' }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FAF7F2;padding:12px 16px;border-bottom:1px solid #E6E1D7;font-weight:600;font-size:13px;color:#16281D;">
                                        Date Received
                                    </td>
                                    <td style="padding:12px 16px;border-bottom:1px solid #E6E1D7;font-size:13px;color:#58544C;">
                                        {{ $enquiry->created_at ? $enquiry->created_at->format('F d, Y \a\t h:i A') : date('F d, Y \a\t h:i A') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FAF7F2;padding:12px 16px;font-weight:600;font-size:13px;color:#16281D;vertical-align:top;">
                                        Event Details
                                    </td>
                                    <td style="padding:12px 16px;font-size:14px;color:#2D2A26;line-height:1.7;white-space:pre-line;">
                                        {{ $enquiry->message }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Admin CTA Button -->
                            <div style="text-align:center;margin-top:30px;">
                                <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" style="display:inline-block;background-color:#16281D;color:#FFFFFF;text-decoration:none;padding:12px 28px;border-radius:4px;font-size:13px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;">
                                    View Enquiry in Admin Panel
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#FAF7F2;padding:24px 40px;border-top:1px solid #EBE5DB;text-align:center;">
                            <p style="margin:0;font-size:12px;color:#8F897D;">
                                © {{ date('Y') }} Azeezia Luxury Convention Centre &amp; Organic Farm Resort. All Rights Reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
