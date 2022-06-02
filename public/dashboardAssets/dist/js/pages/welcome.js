    $(function () {
        $(".data_table").DataTable({
            "ordering": false,
            "language": {
                "lengthMenu": "عرض _MENU_",
                "zeroRecords": "لا يوجد بيانات",
                "info": "صفحة _PAGE_ من _PAGES_",
                "infoEmpty": "لا يوجد بيانات",
                "loadingRecords": "جاري التحميل .....",
                "zeroRecords": "لا يوجد بيانات",
                "processing": "جاري المعالجة .....",
                "paginate": {
                    "first": "الأولى",
                    "last": "الأخيرة",
                    "next": "التالي",
                    "previous": "السابق"
                },
                "search": "بحث : ",
                "emptyTable": "لا يوجد بيانات",
                "infoFiltered": "",
            },
            "paging": true,    

            initComplete: function () {
                $('.dataTables_info').addClass('hide-column');
                $('.dataTables_length').addClass('hide-column');
                $('.dataTables_filter').addClass('hide-column');
                $('.dataTables_paginate').addClass('hide-column');     
                $('.dataTables_filter .form-control').focus();            
            },
            
        });
        

    });