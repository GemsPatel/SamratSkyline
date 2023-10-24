<?php
$headerInfo = getHeaderInformation();
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
    input, select { -prince-pdf-form: enable; }
    :root {
        --font-color: black;
        --highlight-color: #00a5ce;
        --secondary-color: #868f95;
        --header-bg-color: #B8E6F1;
        --footer-bg-color: #BFC0C3;
        --table-img-bg-color: #BFC0C3;
        --gap-size: 15px;
    }
    @page {
        size: A4;
        margin: 4cm 0 3cm 0;
        @top-left { content: element(header); }
        @bottom-left { content: element(footer); }
    }
    * { box-sizing: border-box; }
    body { margin: 0; padding: 0.5cm 0.5cm; color: var(--font-color); font-family: 'Montserrat', sans-serif; font-size: 10pt; }
    a { color: inherit; text-decoration: none; }
    hr { margin: 0.8cm 0; height: 0; border: 0; border-top: 1mm solid var(--highlight-color); }
    header .headerSection { display: flex; height: 3cm; align-items: center; justify-content: space-between; }
    header .headerSection:last-child div:last-child { width: auto; }
    header .logoAndName { display: flex; align-items: center; justify-content: space-between; }
    header .logoAndName svg { width: 1.5cm; height: 1.5cm; margin-right: .5cm; }
    header h1, header h2, header h3, header p { margin: 0; }
    header h2, header h3 { text-transform: uppercase; }
    header h2 { font-size: 120%; }
    footer { height: 1cm; line-height: 1cm; padding: 0 2cm; position: running(footer); background-color: var(--table-img-bg-color); font-size: 8pt; display: flex; align-items: baseline; justify-content: space-between; }
    footer a:first-child { font-weight: bold; }
    table, th, td { border: 1px solid black; padding: 2 px; }
</style>
<!-- The header element will appear on the top of each page of this form document. -->
<header>
    <div class="headerSection">
        <!-- As a logo we take an SVG element and add the name in an standard H1 element behind it. -->
        <div class="logoAndName">
            <img src="{{ url('storage/app/' . $headerInfo->header_logo) }}" class="img-fluid" alt="Phone image" style="width: 100px">
        </div>
        <div>
            <h2 style="text-align: center">
                  <b>{{ $maintananceReport->name }}</b></h2>
            <p style="margin-top: 10px;">
                  <b>Date</b> <span style="text-decoration: underline;">{{ $maintananceReport->start_date }}</span> <b>TO</b> <span style="text-decoration: underline;">{{ $maintananceReport->end_date }}</span>
            </p>
        </div>
        <div>
            <h2>Maintanance Report</h2>
            <p style="margin-top: 5px;">
                <b>Date</b> {{ $maintananceReport->created_at }}
            </p>
        </div>
    </div>
</header>

<main>
      <fieldset>
            <?php
            $totalReceived = 0;
            ?>
            <legend>Received Maintanance</legend>
            <table style="width: 100%">
                  <tr>
                        <td style="width: 50%">
                              <table style="width: 100%">
                                    <tr style="text-align: left;">
                                          <th>No.</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Pay Date</th>
                                    </tr>
                                    @for( $i=0;$i<$halfReceiveMaintanance;$i++ )
                                          <tr>
                                                <td>{{$receiveMaintanance[$i]->home->number}}</td>
                                                <td>{{$receiveMaintanance[$i]->home->name}}</td>
                                                <td>{{shortNumber( $receiveMaintanance[$i]->amount )}}</td>
                                                <td>{{formatDate( 'd-m-Y H:i', $receiveMaintanance[$i]->created_at )}}</td>
                                                <?php
                                                $totalReceived+= $receiveMaintanance[$i]->amount;
                                                ?>
                                          </tr>
                                    @endfor
                              </table>
                        </td>
                        <td style="width: 50%">
                              <table style="width: 100%">
                                    <tr style="text-align: left;">
                                          <th>No.</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Pay Date</th>
                                    </tr>
                                    @for( $i = ( $halfReceiveMaintanance); $i < COUNT( $receiveMaintanance ); $i++ )
                                          <tr>
                                                <td>{{$receiveMaintanance[$i]->home->number}}</td>
                                                <td>{{$receiveMaintanance[$i]->home->name}}</td>
                                                <td>{{shortNumber( $receiveMaintanance[$i]->amount )}}</td>
                                                <td>{{formatDate( 'd-m-Y H:i', $receiveMaintanance[$i]->created_at )}}</td>
                                                <?php
                                                $totalReceived+= $receiveMaintanance[$i]->amount;
                                                ?>
                                          </tr>
                                    @endfor
                              </table>
                        </td>
                  </tr>
            </table>
            <p><b>Total Received:</b> {{number_format( $totalReceived, )}}</p>
      </fieldset>
      
      <hr>

      <fieldset>
            <?php
            $totalPay = 0;
            ?>
            <legend>Paid Maintanance</legend>
            <table style="width: 100%">
                  <tr>
                        <td style="width: 50%">
                              <table style="width: 100%">
                                    <tr style="text-align: left;">
                                          <th>No.</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Pay Date</th>
                                          <th>Create At</th>
                                    </tr>
                                    @for( $i=0;$i<$halfPaidMaintanance;$i++ )
                                          <tr>
                                                <td>{{( $i+1 )}}</td>
                                                <td>{{$paidMaintanance[$i]->title}}</td>
                                                <td>{{shortNumber( $paidMaintanance[$i]->amount )}}</td>
                                                <td>{{formatDate( 'd-m-Y H:i', $paidMaintanance[$i]->paid_date )}}</td>
                                                <td>{{formatDate( 'd-m-Y H:i', $paidMaintanance[$i]->created_at )}}</td>
                                                <?php
                                                $totalPay+= $paidMaintanance[$i]->amount;
                                                ?>
                                          </tr>
                                    @endfor
                              </table>
                        </td>
                        <td style="width: 50%">
                              <table style="width: 100%">
                                    <tr style="text-align: left;">
                                          <th>No.</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Pay Date</th>
                                          <th>Create At</th>
                                    </tr>
                                    @for( $i = ( $halfPaidMaintanance ); $i < COUNT( $paidMaintanance ); $i++ )
                                          <tr>
                                                <td>{{( $i + 1 )}}</td>
                                                <td>{{$paidMaintanance[$i]->title}}</td>
                                                <td>{{shortNumber( $paidMaintanance[$i]->amount )}}</td>
                                                <td>{{formatDate( 'd-m-Y H:i', $paidMaintanance[$i]->paid_date )}}</td>
                                                <td>{{formatDate( 'd-m-Y H:i', $paidMaintanance[$i]->created_at )}}</td>
                                                <?php
                                                $totalPay+= $paidMaintanance[$i]->amount;
                                                ?>
                                          </tr>
                                    @endfor
                              </table>
                        </td>
                  </tr>
            </table>
            <p><b>Total Pay:</b> {{number_format( $totalPay, 2 )}}</p>
      </fieldset>
</main>
  
<footer>
      <a href="https://samratskyline.com"> samratskyline.com </a>
      <a href="mailto:info@samratskyline.com"> info@samratskyline.com </a>
      <span> Dabholi Gam, Katar Gam, Surat, IN 395004 </span>
</footer>