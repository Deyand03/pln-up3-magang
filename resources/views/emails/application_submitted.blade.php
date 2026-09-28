<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Pengajuan Magang PLN UP3 Jambi</title>
</head>

<body
    style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 20px 0; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table role="presentation" width="100%"
                    style="max-width: 580px; background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">

                    <tr>
                        <td style="background-color: #0f766e; padding: 28px 32px; text-align: center;">
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 20px; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase;">
                                PT PLN (Persero) UP3 Jambi
                            </h1>
                            <p style="color: #ccfbf1; margin: 6px 0 0 0; font-size: 13px;">
                                Sistem Informasi Manajemen Magang & PKL
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px;">
                            <h2
                                style="color: #1e293b; font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 12px;">
                                Halo, {{ $application->name }}!
                            </h2>
                            <p
                                style="color: #475569; font-size: 14px; line-height: 1.6; margin-top: 0; margin-bottom: 24px;">
                                Pengajuan pendaftaran magang Anda dari instansi
                                <strong>{{ $application->institution }}</strong> telah berhasil masuk dan tercatat di
                                sistem kami.
                            </p>

                            <div
                                style="background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 24px;">
                                <span
                                    style="display: block; color: #64748b; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">
                                    Nomor Pengajuan Anda
                                </span>
                                <span
                                    style="display: inline-block; background-color: #0f766e; color: #ffffff; font-family: 'Courier New', Courier, monospace; font-size: 22px; font-weight: 700; padding: 10px 20px; border-radius: 8px; letter-spacing: 1.5px;">
                                    {{ $application->registration_number }}
                                </span>
                                <p style="color: #64748b; font-size: 12px; margin: 12px 0 0 0;">
                                    Simpan dan gunakan nomor pendaftaran di atas untuk melakukan pengecekan status
                                    pengajuan.
                                </p>
                            </div>

                            <div style="border-top: 1px solid #f1f5f9; padding-top: 16px; margin-bottom: 24px;">
                                <p style="color: #334155; font-size: 13px; font-weight: 700; margin-bottom: 10px;">
                                    Ringkasan Data Pengajuan:</p>
                                <table width="100%" border="0" cellspacing="0" cellpadding="4"
                                    style="font-size: 13px; color: #475569;">
                                    <tr>
                                        <td width="38%" style="font-weight: 600; color: #64748b;">NIM / NISN:</td>
                                        <td width="62%" style="font-weight: 600; color: #1e293b;">
                                            {{ $application->nim_nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #64748b;">Jumlah Pemagang:</td>
                                        <td style="font-weight: 600; color: #1e293b;">{{ $application->total_interns }}
                                            Orang</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #64748b;">Rencana Periode:</td>
                                        <td style="font-weight: 600; color: #1e293b;">
                                            {{ \Carbon\Carbon::parse($application->start_date)->translatedFormat('d M Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($application->end_date)->translatedFormat('d M Y') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div style="text-align: center; margin-bottom: 12px;">
                                <a href="{{ route('check-status', ['registration_number' => $application->registration_number]) }}"
                                    style="background-color: #0f766e; color: #ffffff; text-decoration: none; font-size: 13px; font-weight: 700; padding: 12px 24px; border-radius: 10px; display: inline-block;">
                                    Cek Progress Pengajuan
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background-color: #f8fafc; padding: 20px 32px; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="color: #94a3b8; font-size: 11px; margin: 0; line-height: 1.5;">
                                Email ini dikirimkan secara otomatis oleh Sistem Informasi Magang PT PLN UP3 Jambi.<br>
                                Harap tidak membalas email ini secara langsung.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
