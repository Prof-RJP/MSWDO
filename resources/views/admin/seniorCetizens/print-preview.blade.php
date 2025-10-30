<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday Celebrants List</title>
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
        // ✅ Filter active seniors only first
        $activeCelebrants = $celebrants->filter(fn($senior) => $senior->status == 'Active');

        // ✅ Then chunk them into 20 per page
        $chunks = $activeCelebrants->values()->chunk(20);

        // ✅ Start numbering manually
        $no = 1;
    @endphp

    @foreach ($chunks as $chunkIndex => $chunk)
        <div class="flex items-center justify-evenly">
            <div class="flex">
                <img src="{{ asset('images/BAGONG PILIPINAS.png') }}" alt="Left Logo" class="h-24">
                <img src="{{ asset('images/logo.jpg') }}" alt="Left Logo" class="h-24">
            </div>

            <div class="flex flex-col items-center flex-2 text-center">
                <img src="{{ asset('images/BAYAN NG SAN QUINTIN.png') }}" alt="Center Logo" class="w-16 h-16">
                <h4 class="text-base font-cinzel uppercase leading-tight block">Republic of the Philippines</h4>
                <h4 class="text-base font-cinzel uppercase leading-tight">Province of Pangasinan</h4>
                <h4 class="text-base font-cinzel uppercase leading-tight">Municipality of San Quintin</h4>
            </div>
            <div class="flex-1 flex justify-end items-center">
                <img src="{{ asset('images/FSB LOGO.png') }}" alt="Right Logo" class="w-24 h-24 object-contain">
            </div>

        </div>

        <div class="flex text-center w-full mt-4 mb-2 font-semibold text-lg">
            <span class="bg-[#00CC00] border border-t-[#008000] border-b-[#008000] font-black flex justify-center items-center uppercase px-4 text-white w-screen font-sans">
                Municipal Social Welfare and Development Office
            </span>
        </div>

        <div class="text-center mb-2">
            <div class="capitalize text-3xl">regalo para kay lolo at lola</div>
            <div class="capitalize text-3xl -mt-1">{{ $event->title }}</div>
            <div class="-mt-1 text-2xl">{{ \Carbon\Carbon::parse($event->starts_at)->format('F Y') }}</div>
        </div>

        <table class="mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-lg w-12">No.</th>
                    <th class="text-lg">Name</th>
                    <th class="text-lg">Barangay</th>
                    <th class="text-lg">Birthdate</th>
                    <th class="text-lg w-36">Signature</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chunk as $senior)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="uppercase text-left pl-3">
                            {{ $senior->lname }}, {{ $senior->fname }} {{ $senior->mname ?? '' }}
                        </td>
                        <td>{{ $senior->barangay->barangay ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($senior->birthdate)->format('m/d/Y') }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <footer>
    <div class="footer-line">
        <div class="footer-label">
            <div class="flex flex-col items-center justify-center">
                <p>"Serbisyong Farah Sa Bayan"</p>
                <div>
                    <p class="relative flex items-center gap-2">
                    <span class="absolute left-0">
                        <img src="{{ asset('images/envelop.png') }}" class="w-4 h-4" alt="">
                    </span>
                    <span class="ml-6">mswdosanquintin@gmail.com</span>
                </p>
                </div>

                <div>
                    <p class="relative flex items-center gap-2">
                    <span class="absolute left-0">
                        <img src="{{ asset('images/contact.png') }}" class="w-4 h-4" alt="">
                    </span>
                    <span class="ml-6">0917-546-7220</span>
                </p>
                </div>

            </div>
        </div>
    </div>
</footer>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>
</html>
