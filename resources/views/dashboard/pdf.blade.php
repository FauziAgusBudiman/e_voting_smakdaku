<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pemilihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #2c3e50;
        }

        .stats {
            margin-bottom: 30px;
        }

        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Pemilihan</h1>
        <p>Dibuat pada: {{ $date }}</p>
    </div>

    <div class="stats">
        <h2>Statistik Pemilihan</h2>
        <div class="stat-card">
            <strong>Total Pemilih:</strong> {{ $totalVoters }}
        </div>
        <div class="stat-card">
            <strong>Pemilih yang Telah Memilih:</strong> {{ $votersWhoVoted }}
            ({{ round(($votersWhoVoted / $totalVoters) * 100, 2) }}%)
        </div>
        <div class="stat-card">
            <strong>Pemilih yang Belum Memilih:</strong> {{ $votersNotVoted }}
            ({{ round(($votersNotVoted / $totalVoters) * 100, 2) }}%)
        </div>
    </div>

    <h2>Perolehan Suara Kandidat</h2>
    <table>
        <thead>
            <tr>
                <th>Nomor Pemilihan</th>
                <th>Total Suara</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidateVoteData as $number => $votes)
                <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $votes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
