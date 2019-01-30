<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DataTables | Gentelella</title>

    <!-- Bootstrap -->
    <link href="../Boot/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../Boot/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../Boot/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../Boot/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../Boot/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../Boot/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../Boot/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">


              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
					
                    <table id="datatable-responsive" class="dt-responsive  table-bordered  dt-responsive " cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                          <th>Extn.</th>
                          <th>E-mail</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jennifer</td>
                          <td>Acosta</td>
                          <td>Junior Javascript Developer</td>
                          <td>Edinburgh</td>
                          <td>43</td>
                          <td>2013/02/01</td>
                          <td>$75,650</td>
                          <td>3431</td>
                          <td>j.acosta@datatables.net</td>
                        </tr>
                        <tr>
                          <td>Cara</td>
                          <td>Stevens</td>
                          <td>Sales Assistant</td>
                          <td>New York</td>
                          <td>46</td>
                          <td>2011/12/06</td>
                          <td>$145,600</td>
                          <td>3990</td>
                          <td>c.stevens@datatables.net</td>
                        </tr>
                        <tr>
                          <td>Hermione</td>
                          <td>Butler</td>
                          <td>Regional Director</td>
                          <td>London</td>
                          <td>47</td>
                          <td>2011/03/21</td>
                          <td>$356,250</td>
                          <td>1016</td>
                          <td>h.butler@datatables.net</td>
                        </tr>
                        <tr>
                          <td>Lael</td>
                          <td>Greer</td>
                          <td>Systems Administrator</td>
                          <td>London</td>
                          <td>21</td>
                          <td>2009/02/27</td>
                          <td>$103,500</td>
                          <td>6733</td>
                          <td>l.greer@datatables.net</td>
                        </tr>
                        <tr>
                          <td>Jonas</td>
                          <td>Alexander</td>
                          <td>Developer</td>
                          <td>San Francisco</td>
                          <td>30</td>
                          <td>2010/07/14</td>
                          <td>$86,500</td>
                          <td>8196</td>
                          <td>j.alexander@datatables.net</td>
                        </tr>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../Boot/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../Boot/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../Boot/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../Boot/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../Boot/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../Boot/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../Boot/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../Boot/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../Boot/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../Boot/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../Boot/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../Boot/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../Boot/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../Boot/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../Boot/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../Boot/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../Boot/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../Boot/vendors/jszip/dist/jszip.min.js"></script>
    <script src="../Boot/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../Boot/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../Boot/build/js/custom.min.js"></script>

  </body>
</html>