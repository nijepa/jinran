<script src="{{ asset('js/backend_js/excanvas.min.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.min.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.ui.custom.js') }}"></script>
<script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.flot.min.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/backend_js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.dashboard.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.interface.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.chat.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.wizard.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script>
<script src="{{ asset('js/backend_js/select2.min.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script>
<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>
<script type="text/javascript">
    var col = new String();
    var x=1;var y;

    function blink()
    {
        if(x%2)
        {
            col = "rgb(255,102,102)";
        }else{
            col = "rgb(255,255,255)";
        }

        aF.style.color=col;x++;if(x>2){x=1};setTimeout("blink()",500);
        aA.style.color=col;x++;if(x>2){x=1};setTimeout("blink()",500);
    }
</script>