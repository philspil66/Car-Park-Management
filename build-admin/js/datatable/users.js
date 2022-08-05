var datatable_users = {
    deBounce: 0
    ,
    /**
     * Searches user table
     * @param elm   Input field to query against
     * @param users_table Element searching against
     */
    userTableSearch: function (elm, users_table) {
        var val = elm.val();
        if (val != '') {
            users_table.search(elm.val()).draw();
        }
    },
    init: function () {
        var $this = this;
        var users_table = $('#users-table').DataTable({

            pageLength: 20,
            bAutoWidth: false,
            dom: "tipr",
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/users/data',
                data: function (d) {

                    var search_term = $('.search-input').val();
                    var search_column = $('.search-column').val();

                    if (search_column == 'postcode') {
                        search_term = search_term.replace(/\s/g, '');
                        d.search.value = search_term.toUpperCase();
                    }
                    else {
                        d.search.value = search_term.toLowerCase();
                    }

                    d.search_column = $('.search-column').val();

                }
            },
            pagingType: 'simple_numbers',

            columns: [
                {data: 'id', name: 'id'},
                {data: 'firstname', name: 'firstname'},
                {data: 'lastname', name: 'lastname'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'postcode', name: 'postcode'},
                {data: 'id', name: 'id'}
            ],

            oLanguage: {
                sLengthMenu: '<select>' +
                '<option value="20">20</option>' +
                '<option value="50">50</option>' +
                '<option value="100">100</option>' +
                '</select> Records per page',
                sProcessing: '<div class="spinner"><i class="icon-spinner"></i></div>'
            },

            columnDefs: [
                {"width": "5%", "targets": 0},//id
                {"width": "20%", "targets": 1},//first_name
                {"width": "20%", "targets": 2},//last_name
                {"width": "30%", "targets": 3},//role
                {"width": "10%", "targets": 4},//email
                {"width": "15%", "targets": 5},//postcode
                // impersonate
                {
                    "width": "5%",
                    "targets": 6,
                    "render": function (data, type, row) {

                        var link = '<a class="icon--link" href="/admin/impersonate/?user_id='
                            + data + '"><i class="icon-user"></i></a>';
                        var edit_link = '<a class="icon--link" href="/admin/users/add-edit?id='
                            + data + '"><i class="icon-pencil"></i></a>';
                        return link + edit_link;
                    }
                }
            ]

        });

        // users table uses custom search box as we need a select filter
        // default one is disabled in 'dom' options above
        $('.search-input').on('keyup', function () {
            if ($this.deBounce > 0) {
                clearTimeout($this.deBounce);
            }
            $this.deBounce = setTimeout(
                $this.userTableSearch($(this), users_table),
                200);
            // moved to function userTableSearch
            // users_table.search($(this).val()).draw();
        });

        // change filter event (re-searches on selected column)
        $('.search-column').on('change', function () {
            if ($this.deBounce > 0) {
                clearTimeout($this.deBounce);
            }
            $this.deBounce = setTimeout(
                $this.userTableSearch($('.search-input'), users_table),
                200);
            // moved to function userTableSearch
            // users_table.search($('.search-input').val()).draw();
        });

    }

};

module.exports = datatable_users;
