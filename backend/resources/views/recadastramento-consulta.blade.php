

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
   <head>
      <meta http-equiv="Content-Security-Policy" content="script-src 'none'; connect-src 'none'; object-src 'none'; form-action 'none';">
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta name="x-apple-disable-message-reformatting">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="telephone=no" name="format-detection">
      <title>Consulta</title>
      <!--[if (mso 16)]>
      <style type="text/css">
         a {text-decoration: none;}
      </style>
      <![endif]--> 
      <!--[if gte mso 9]>
      <style>sup { font-size: 100% !important; }</style>
      <![endif]--> 
      <!--[if gte mso 9]>
      <xml>
         <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
         </o:OfficeDocumentSettings>
      </xml>
      <![endif]--> 
      <style type="text/css">
         div.minimalistBlack {
            border: 3px solid #000000;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
          }
          .divTable.minimalistBlack .divTableCell, .divTable.minimalistBlack .divTableHead {
            border: 1px solid #000000;
            padding: 5px 4px;
          }
          .divTable.minimalistBlack .divTableBody .divTableCell {
            font-size: 13px;
          }
          .divTable.minimalistBlack .divTableHeading {
            border-bottom: 3px solid #000000;
          }
          .divTable.minimalistBlack .divTableHeading .divTableHead {
            font-size: 15px;
            font-weight: bold;
            color: #000000;
            text-align: left;
          }
          .minimalistBlack .tableFootStyle {
            font-size: 14px;
          }
          /* DivTable.com */
          .divTable{ display: table; }
          .divTableRow { display: table-row; }
          .divTableHeading { display: table-header-group;}
          .divTableCell, .divTableHead { display: table-cell;}
          .divTableHeading { display: table-header-group;}
          .divTableFoot { display: table-footer-group;}
          .divTableBody { display: table-row-group;}
      </style>
      <style>
          footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px;
            }
        .page-number:after { 
            content: "Página: " counter(page);
            text-align: right;
        }
        .left{
            float: left;
            width : 50%;
        }
        .right{
            float: right;
            width : 50%;
            text-align: right;
        }
      </style>
      
      <base href="#">
   </head>
   <body style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">       
       <h1>Consulta de recadastramentos</h1>
       <h3>Critérios selecionados</h3>
       <p>
           Filtro: {{$criterios['filtro']}}<br/>
           Ordenação: {{$criterios['ordenacao']}}<br/>
           Situação: {{$criterios['situacao']}}<br/>
           Situações: {{$criterios['situacoes']}}
       </p>
       <div class="divTable minimalistBlack">
           <div class="divTableHeading">
               <div class="divTableRow">
                   <div class="divTableHead">Data</div>
                   <div class="divTableHead">Matrícula</div>
                   <div class="divTableHead">Nome</div>
                   <div class="divTableHead">Protocolo</div>
                   <div class="divTableHead">Situação</div>
               </div>
           </div>
           <div class="divTableBody">
               @foreach($recadastramentos as $recadastramento)
               <div class="divTableRow">
                   <div class="divTableCell">{{isset($recadastramento->created_at) ? date('d/m/Y', strtotime($recadastramento->created_at)) : ''}}</div>
                   <div class="divTableCell">{{$recadastramento->matricula}}</div>
                   <div class="divTableCell">{{$recadastramento->nome}}</div>
                   <div class="divTableCell">{{$recadastramento->codigo}}</div>
                   <div class="divTableCell">{{$recadastramento->situacao}}</div>
               </div>
               @endforeach
           </div>
       </div>
        <footer>
           <hr/>
           <div class="left">
               <span class="report-time">{{date('d/m/Y H:i:s')}}</span><br>
           </div>
           <div class="right">
               <span class="page-number"></span>
           </div>
       </footer>
   </body>
</html>

