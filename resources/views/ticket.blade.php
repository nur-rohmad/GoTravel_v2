<link rel="shortcut icon" type="image/x-icon" href="{{ public_path(" assets/images/logo_GoTravel.png") }}">
<link href="/assets/css/style.css" rel="stylesheet">
<style>
    @page {
        margin: 0;
    }

    .box-ticket {
        border: 1px solid white;
        background-image: url('{{ public_path("assets/images/logo_GoTravel.png") }}') !important;
        background-size: 15%;
        background-repeat: no-repeat;
        /* opacity: 0.4; */
    }

    .text-center {
        text-align: center !important;
    }

    .d-flex {
        display: flex !important;
    }

    /* tr {
        height: 800px;
    } */

    .justify-content-between {
        justify-content: space-between !important;
    }

    .title h2 {
        font-style: italic;
        text-decoration: underline;
        color: blanchedalmond;
        font-weight: bold;
    }

    .content h2 {
        font-style: italic;
        text-decoration: underline;
        color: blanchedalmond;
    }

    .row {
        display: flex;
        flex-direction: row
    }

    .col-left {
        flex-basis: 50%;
    }

    #image {
        position: absolute;
        z-index: -1;
        opacity: 0.4;
    }

    .col-right {
        flex-basis: 50%;
    }

    /* p {
        position: absolute;
        color: blanchedalmond;
        font-weight: bold;
        text-decoration: none;
        bottom: -30px;
        left: 50%;
        transform: translate(-50%, -50%);
    } */

    table {
        margin: 0px 20px;
        border-spacing: 15px
    }
</style>


<div class="box-ticket">
    <div class="row">
        <h4 class="text-center">PT GO-TRAVEL INDONESIA</h4>
        <p class="text-center" style="color: black; margin-top: -10px; margin-left: 90px; margin-right: 90px"> Jl.
            Gendong Rt. 015, Rw. 009,
            Kel.
            Banjarejo,
            Kec. Taman, Kota Madiun
        </p>
        <p class="text-center"
            style="color: white; margin-top: -5px; background-color: blue; padding: 2px 10px; font-weight: bold">{{
            strtoupper($booking->open_trip->title)
            }}</p>
        <div class="col-left">
            <img id="image" src="{{ public_path('assets/images/logo_GoTravel.png') }}" width="50%">
            <table width="80%">
                <tr>
                    <td>Tanggal Keberangkatan</td>
                    <td>:</td>
                    <td>{{ date("d M Y, H:i", strtotime($booking->open_trip->tgl_berangkat)) }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $booking->user->name }}</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>:</td>
                    <td>{{ $booking->user->email }}</td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td>:</td>
                    <td>{{ $booking->user->NoHP }}</td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($booking->open_trip->harga) }}</td>
                </tr>
                <tr>
                    <td>Jumlah </td>
                    <td>:</td>
                    <td>{{ $booking->jumlah_booking }} orang</td>
                </tr>
                <tr>
                    <td>Total Harga </td>
                    <td>:</td>
                    <td>Rp. {{ number_format($booking->invoice->amount) }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>