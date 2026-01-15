<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar Pemilih</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .date {
            text-align: right;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>

<body>
    <h1>DAFTAR FINAL PEMILIH</h1>
    <div class="date">Dibuat: {{ $date }}</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NISN</th>
                <th>Status Pemilihan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voters as $voter)
                <tr>
                    <td>{{ $voter->number }}</td>
                    <td>{{ $voter->name }}</td>
                    <td>{{ $voter->email }}</td>
                    <td>{{ $voter->nisn }}</td>
                    <td>{{ $voter->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} E-Voting. ASMAKDAKU.
    </div>
</body>

</html>
