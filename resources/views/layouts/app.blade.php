<!DOCTYPE html>
<html lang="fr">
    {{-- Include Head --}}
    @include('common.head')
    <body data-topbar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">
            <!-- Topbar -->
            <header id="page-topbar">
                @include('common.header')
            </header>
            <!-- End of Topbar -->
            
            <!-- Sidebar -->
            <div class="vertical-menu">
                @include('common.sidebar')
            </div>
            <!-- End of Sidebar -->
            
            <!-- Content Wrapper -->
            <div class="main-content">
                <!-- Main Content -->
                <div id="page-content">
                    <div class="container-fluid mb-5">
                        <!-- Begin Page Content -->                    
                            @yield('content')
                        <!-- /.container-fluid -->
                    </div>                    
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                @include('common.footer')
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Logout Modal-->
        @include('common.logout-modal')

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <!-- Bootstrap core JavaScript-->
        <button onclick="scrollToTop()" id="scrollToTopBtn"><i class="fas fa-angle-up"></i></button>
        <script>
            window.onscroll = function() {
            scrollFunction();
            };

            function scrollFunction() {
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');

            // Show the button when the user scrolls down 20px from the top of the document
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
            }

            function scrollToTop() {
            // Scroll to the top of the document
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
            }
        </script>

        <script>
            function hideRow(table,rowIndex){
                var elt = document.getElementById('liste_ecoles');
                for (var i = 0, row; row = elt.length; i++) {
                    if(rowIndex==i){
                        row.className ="hiddenclass";
                    }
                }        
            }

            function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('liste_ecoles');
            hideRow(  elt,2);
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1", ignoreHiddenRows: true });
            
                return dl ?
                    XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                    XLSX.writeFile(wb, fn || ('liste_ecoles.' + (type || 'xlsx')));
            }
        </script>

        @include('common.scripts')

    </body>

</html>