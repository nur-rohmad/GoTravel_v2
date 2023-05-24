<style>
    @page { margin: 0; }
    .box-ticket {
        width: 800px;
        height: 264px;
        border: 1px solid white;
        background-image: url('{{ public_path("storage/" . $booking->open_trip->poster) }}') !important;
        background-size: cover;
        opacity: 0.8;
    }

    .text-center {
        text-align: center !important;
    }

    .d-flex {
        display: flex !important;
    }

    .justify-content-between {
        justify-content: space-between !important;
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
    table {
        margin: 0px 20px
    }
</style>

@foreach ($ticket as $key => $item)
    <div class="box-ticket">
        <div class="title">
            <table width="90%">
                <tr>
                    <td>
                        <h2>E-Ticket</h2>
                    </td>
                    <td align="right">
                        <h2>Go-Travel</h2>
                    </td>
                </tr>
            </table>
        </div>
        <div class="content text-center">
            <h2>Promo Akhir Tahun</h2>
            <h4 style="color: blanchedalmond; margin-top: -10px">{{ $item->no_ticket }}</h4>
            <img class="mb-2" src="{{ public_path("assets/images/qrcod.png") }}" alt="tes" width="70px">
        </div>

        <p class="text-center">Tiket dicetak melalui <a href="/">go-travel.site</a> pada tanggal
            {{ date('d M Y', strtotime($item->created_at)) }}</p>
    </div>
@endforeach
