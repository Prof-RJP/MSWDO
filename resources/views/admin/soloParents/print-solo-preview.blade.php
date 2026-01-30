<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Parent List</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @page {
            size: 8.5in 13in;
            margin: 0.5in;
        }

        @media print {

            html,
            body {
                margin: 0;
                padding: 0;
                font-family: 'Times New Roman', serif;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                page-break-inside: auto;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            th,
            td {
                border: 1px solid black;
                padding: 6px 8px;
                text-align: center;
                font-size: 14px;
            }

            .page-break {
                page-break-after: always;
            }

            footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                height: 60px;
            }

            .footer-line {
                border-top: 12px solid #00CC00;
                position: relative;
                margin: 0 auto;
                width: 100%;
            }

            .footer-label {
                position: absolute;
                top: -14px;
                left: 50%;
                transform: translateX(-50%);
                background: white;
                padding: 0 10px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body onload="window.print()" class="text-[14px] text-black h-screen w-screen">

    @php
        // Chunk clients into 20 rows per page
        $chunks = $clients->chunk(20);
        $no = 1;
    @endphp

    @foreach ($chunks as $chunk)
        <!-- HEADER -->
        <div class="flex items-center justify-evenly">
            <div class="flex">
                <img src="{{ asset('images/BAGONG PILIPINAS.png') }}" class="h-24">
                <img src="{{ asset('images/logo.jpg') }}" class="h-24">
            </div>

            <div class="flex flex-col items-center flex-2 text-center">
                <img src="{{ asset('images/BAYAN NG SAN QUINTIN.png') }}" class="w-16 h-16">
                <h4 class="text-base uppercase leading-tight">Republic of the Philippines</h4>
                <h4 class="text-base uppercase leading-tight">Province of Pangasinan</h4>
                <h4 class="text-base uppercase leading-tight">Municipality of San Quintin</h4>
            </div>

            <div class="flex-1 flex justify-end items-center">
                <img src="{{ asset('images/FSB LOGO.png') }}" class="w-24 h-24 object-contain">
            </div>
        </div>

        <div class="flex text-center w-full mt-4 mb-2 font-semibold text-lg">
            <span
                class="bg-[#00CC00] border border-t-[#008000] border-b-[#008000] font-black flex justify-center items-center uppercase px-4 text-white w-screen">
                Municipal Social Welfare and Development Office
            </span>
        </div>

        <div class="text-center mb-2">
            <div class="capitalize text-3xl">SOLO PARENT LIST</div>
            <div class="capitalize text-normal italic">
    Year {{ $year ?? now()->year }}
</div>
        </div>

        <!-- TABLE -->
        <table class="mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-lg">No.</th>
                    <th class="text-lg">ID No.</th>
                    <th class="text-lg">Name</th>
                    <th class="text-lg">Barangay</th>
                    <th class="text-lg">Birthdate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chunk as $sp)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $sp->id_no }}</td>
                        <td class="uppercase text-left pl-3">
                            {{ $sp->client->lname }}, {{ $sp->client->fname }} {{ $sp->client->mname ?? '' }}
                        </td>
                        <td>{{ $sp->client->barangays->barangay ?? 'N/A' }}</td>

                        <td>{{ \Carbon\Carbon::parse($sp->client->birthdate)->format('m/d/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!-- FOOTER -->
        <footer>
            <div class="footer-line"></div>

            <div class="footer-label flex flex-col items-center text-center leading-tight">

                <p class="italic">"Serbisyong Farah Sa Bayan"</p>

                <p class="flex items-center justify-center gap-2 mt-1">
                    <img src="{{ asset('images/envelop.png') }}" class="w-4 h-4" alt="">
                    <span>mswdosanquintin@gmail.com</span>
                </p>

                <p class="flex items-center justify-center gap-2 mt-1">
                    <img src="{{ asset('images/contact.png') }}" class="w-4 h-4" alt="">
                    <span>0917-546-7220</span>
                </p>

            </div>
        </footer>


        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
    <div class="flex justify-between items-center">
        <div>
            Prepared by:
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-col items-center">
                    <br><br>
                    <h1 class="uppercase font-bold">Sharmaine B. Rous</h1>
                    <p>SWA</p>
                </div>
            </div>
        </div>
        <br>
        <div>
            Noted by:
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-col justify-center items-center">
                    <br><br>
                    <h1 class="uppercase font-bold">Delia C. quero, rsw</h1>
                    <p>MSWDO</p>
                </div>
            </div>
        </div>
        <br>
        <div>
            Approved by:
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-col justify-center items-center">
                    <br><br>
                    <h1 class="uppercase font-bold">Farah lee m. lumahan</h1>
                    <p>Municipal Mayor</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
