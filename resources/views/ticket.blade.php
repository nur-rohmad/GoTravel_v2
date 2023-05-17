<link id="style" href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    @media print {
        @page {
            size: 21.16667cm 7cm;
        }
    }


    .box-ticket {
        /* margin-top: 1em;
        margin-left: 1em; */
        padding: 20px 30px;
        width: 800px;
        height: 264px;
        border: 1px solid white;
        background-image: url('{{ asset(' storage/'. $booking->open_trip->poster) }}');
        background-size: cover;
        opacity: 0.8;
    }

    .title h2 {
        font-style: italic;
        text-decoration: underline;
        color: blanchedalmond;
    }

    .content h2 {
        font-style: italic;
        text-decoration: underline;
        color: blanchedalmond;
    }

    p {
        color: blanchedalmond;
        bottom: 0px;
    }
</style>

@foreach ($ticket as $key => $item)
<div class="box-ticket">
    <div class="title d-flex justify-content-between">
        <h2>E-Ticket</h2>
        <h2>Go-Travel</h2>
    </div>
    <div class="content text-center">
        <h2>Promo Akhir Tahun</h2>
        <h4 style="color: blanchedalmond; margin-top: -10px">{{ $item->no_ticket }}</h4>
        <img class="mb-2" src="/assets/images/qrcod.png" alt="tes" width="70px">
    </div>

    <p class="text-center">Tiket dicetak melalui <a href="/">go-travel.site</a> pada tanggal {{ date("d M Y",
        strtotime($item->created_at)) }}</p>
</div>
@endforeach

<script>
    window.print()
</script>