<html>

<head></head>

<body style="padding: 0; margin:0;">
    <style>
        .barcode {
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            padding: 0 auto;
        }

        span {
            padding-top: 8px;
            font-weight: bold;
            letter-spacing: 2px;
            font-size: 0.8rem;
        }

        .tc {
            text-align: center;
        }

        .rTable {
            width: 100%;
            margin-top: 10px;
            font-size: 8px;
        }

        .fs-16 {
            font-size: 16px;
        }

        .w50 {
            width: 50%;
        }

        .w10 {
            width: 10%;
        }

        .w40 {
            width: 40%;
        }

        .fs-12 {
            font-size: 8px;
            font-weight: bold;
        }

        table, th, td {
          border: 1px solid grey;
        }
        td {
          padding: .625rem;
          text-transform: uppercase;
        }
    </style>
    <div style="margin:0 auto;display:flex;align-items:center;flex-direction:column; width: 90%;">
        {{-- <img src="https://1.bp.blogspot.com/-QQd7JktIyVo/XUr7YH242bI/AAAAAAAAAVs/sNtR0VQ3hUs9rjCAYVwyFJfL9GkrkbOGgCLcBGAs/s1600/1.JATENG.png" alt="" style="width : 10mm; margin-bottom : 10px"> --}}
        <h1 class="tc fs-16">SIP-GARDAN</h1><br/>
        <table class="rTable" style="">
          <tbody>
              <tr>
                  <td>Nama</td>
                  <td>{{ $detail['nama'] }}</td>
              </tr>
              <tr>
                  <td>Alamat</td>
                  <td>{{ $detail['alamat'] }}</td>
              </tr>
              <tr>
                  <td>No Telfon</td>
                  <td>{{ $detail['phone'] }}</td>
              </tr>
              <tr>
                  <td>Daerah Irigas</td>
                  <td>{{ $detail['di'] }}</td>
              </tr>
              <tr>
                  <td>Jenis Pelanggaran</td>
                  <td>{{ $detail['jp'] }}</td>
              </tr>
              <tr>
                  <td>Kordinat</td>
                  <td>{{ $detail['kordinat'] }}</td>
              </tr>
              <tr>
                  <td>Nama Pelapor</td>
                  <td>{{ $detail['pelapor_name'] }}</td>
              </tr>
          </tbody>
        
      </table>   
    </div>
</body>

</html>
