(function ($) {
    "use strict";
 
    checkToken();
    var fullHeight = function () {
        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });
    };
    fullHeight();
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var mod = urlParams.get('mod')
    var d_name = urlParams.get('d_name')

    if (mod == 'index' || mod == null) {
        syncAllData();
        checkOnlineStatus();
        setInterval(syncAllData, 420000);
    }

    if (mod == 'domains') {
        syncDomains().done(function (data) {
            if (data.res == true) {
                $('#btn-sync-domain').html('Sync');
                domainsDataTable.ajax.reload();
                swal("Success", "Data successfully synced.", "success");
            }
        })
    }
    
    setInterval(async () => {
        checkOnlineStatus();
    }, 3000);

    var domainsDataTable = $('#domains').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "../app/modules/domains/getdomains.php",
            method: "POST"
        },
        columns: [
            {
                "data": "d_id",
                orderable: false
            },
            {
                "data": "name"
            },
            {
                "data": "status"
            },
            {
                "data": "registered_on"
            },
            {
                "data": "expires_on"
            },
            {
                "data": "privacy_protection"
            },
            {
                "data": "username"
            },
            {
                "data": "days_remaining"
            },
            {
                "data": "buttons"
            }
        ]
    });

    var accountsDataTable = $('#accounts').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "../app/modules/accounts/getaccounts.php",
            method: "POST",
        },
        columns: [
            {
                "data": "id"
            },
            {
                "data": "username"
            },
            {
                "data": "password"
            },
            {
                "data": "auth_id"
            },
            {
                "data": "auth_password"
            },
            {
                "data": "domain_count"
            },
            {
                "data": "buttons"
            }
        ]
    });

    $(document).on('submit', '#accounts_form', function (event) {
        event.preventDefault();
        var authid = $('#authid').val();
        var authpassword = $('#authpassword').val();
        if (authid != '' && authpassword != '') {
            $.ajax({
                url: "../app/modules/accounts/create-or-update.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    var res = JSON.parse(data);
                    if (res.res == true) {
                        swal("Success", res.msg, "success");
                        $('#accounts_form')[0].reset();
                        $('#accountsModal').modal('hide');
                        accountsDataTable.ajax.reload();
                    } else {
                        swal("Error", res.msg, "error");
                        $('#accounts_form')[0].reset();
                        $('#accountsModal').modal('hide');
                        accountsDataTable.ajax.reload();
                    }
                }
            });
        }
        else {
            alert("All Fields are Required");
        }
    });

    $(document).on('click', '.update-account', function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "../app/modules/accounts/fetchaccount.php",
            method: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function (data) {
                $('#accountsModal').modal('show');
                $('#authid').val(data.auth_id);
                $('#username').val(data.username);
                $('#authpassword').val(data.auth_password);
                $('#password').val(data.password);
                $('#id').val(data.id);
                $('.modal-title').text("Update Account");
                $('#id').val(id);
                $('#action').val("Update");
                $('#operation').val("Update");
            }
        })
    });

    $('#btn-add-account').click(function () {
        $('#accounts_form')[0].reset();
        $('.modal-title').text("New Account");
        $('#action').val("Add");
        $('#operation').val("Add");
    });

    $(document).on('click', '.delete-account', function () {
        var id = $(this).attr("id");
        var action = $(this).attr("action");
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this account",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "../app/modules/accounts/delete.php",
                    method: "POST",
                    data: { id: id, action: action },
                    success: function (data) {
                        var res = JSON.parse(data);
                        if (res.res == true) {
                            swal("Success", res.msg, "success");
                        } else {
                            swal("Canceled", res.msg, "info");
                        }
                        accountsDataTable.ajax.reload();
                    }
                })
            } else {
                swal("Cancelled", "Account not removed", "error");
            }
        })
    });

    $(document).on('click', '.view-account', function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "../app/modules/accounts/view-account.php",
            method: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function (data) {
                $('#accountViewModal').modal('show');
                $('#accountusername').val(data.username);
                $('#accountpassword').val(data.password);
                $('#accountauthid').val(data.auth_id);
                $('#accountauthpassword').val(data.auth_password);
                $('#accountbalance').val(data.account_balance);
                $('#acc_id').val(data.id);
                $('.modal-title').text("View Account");
                $('#id').val(id);
                $('#action').val("Update");
                $('#operation').val("Update");
            }
        })
    });

    $(document).on('click', '.btn-new-domain', function () {
        $.ajax({
            url: "../app/modules/domains/get-accounts.php",
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#domainsModal').modal('show');
                $('#ajaxData').empty();
                for (var i = 0; i < data.length; i++) {
                    $('#ajaxData').append('<option value="' + data[i]['id'] + '">' + data[i]['username'] + ' - ' + data[i]['auth_id'] + '</option>');
                }

            }
        })
    });

    $(document).on('submit', '#domains_form', function (event) {
        event.preventDefault();
        $.ajax({
            url: "../app/modules/domains/add-domain.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                var res = JSON.parse(data);
                if (res.res == true) {
                    alert(res.msg)
                    $('#domains_form')[0].reset();
                    $('#domainsModal').modal('hide');
                    domainsDataTable.ajax.reload();
                } else {
                    alert(res.msg)
                    $('#domains_form')[0].reset();
                    $('#domainsModal').modal('hide');
                    domainsDataTable.ajax.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn-view-name-server', function () {
        var a_id = $(this).attr("id");
        var d_name = $(this).attr("data");
        $.ajax({
            url: "../app/modules/domains/get-name-servers.php",
            method: "GET",
            dataType: "JSON",
            data: { a_id: a_id, d_name: d_name },
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));
                $.each(response, function (i, item) {
                    $('<tr>').html("<td>" + response[i].id + "</td><td>" + response[i].name + "</td>").appendTo('#name-server-details');
                });
                $('#nameServersModal').modal('show');
            }
        });
    });

    $(document).on('click', '.clear-dom-modal', function () {
        $("#name-server-details").empty();
    });

    $(document).on('click', '.btn-delete-domain', function () {
        var id = $(this).attr("id");
        var d_name = $(this).attr("data");
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this domain.",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "../app/modules/domains/delete.php",
                    method: "POST",
                    dataType: "JSON",
                    data: { id: id, d_name: d_name, action: 'delete' },
                    success: function (data) {
                        if (data.res == true) {
                            swal("Success", data.msg, "success");
                            domainsDataTable.ajax.reload();
                        } else {
                            swal("Error", data.msg, "error");
                            domainsDataTable.ajax.reload();
                        }
                    }
                })
            } else {
                swal("Cancelled", "Domain not removed", "error");
            }
        })

    });

    var dnsTable = $('#dnsrecords-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "../app/modules/dnsrecords/get-dns-records.php",
            method: "POST"
        },
        columns: [
            // {
            //     "data": "id"
            // },
            {
                "data": "domain_name"
            },
            {
                "data": "type"
            },
            {
                "data": "host"
            },
            {
                "data": "record"
            },
            {
                "data": "failover"
            },
            {
                "data": "ttl"
            },
            {
                "data": "status"
            },
            {
                "data": "buttons"
            },
        ],
        initComplete: function () {
            this.api().columns(0).every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        dnsTable.search(this.value).draw();
                    });
                $.ajax({
                    url: "../app/modules/dnsrecords/get-distinct-domains.php",
                    method: "GET",
                    dataType: "JSON",
                    success: function (data) {
                    data.forEach(element =>   column.data( select.append('<option value="' + element.domain_name + '">' + element.domain_name + '</option>') ) );                     
                    }
                });
            });
            this.api().columns(1).every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        dnsTable.search(this.value).draw();
                    });
                $.ajax({
                    url: "../app/modules/dnsrecords/get-distinct-types.php",
                    method: "GET",
                    dataType: "JSON",
                    success: function (data) {
                    data.forEach(element =>   column.data( select.append('<option value="' + element.type + '">' + element.type + '</option>') ) );                     
                    }
                });
            });
        }
    });

    $('#dnsrecords-table').on('click', 'tbody .edit-record', function () {
        var data_row = dnsTable.row($(this).closest('tr')).data();
        console.log(data_row)
        $('#dnsRecModal').modal('show');
        $('#dns-record-id').prop('readonly', true);
        $('#dns-record-id').val(data_row.id);
        $('#domain_name').val(data_row.domain_name);
        $('#host').val(data_row.host);
        $('#ttl').val(data_row.ttl);
        $('#type').val(data_row.type);
        $('#record').val(data_row.record);
        $('#fail_over').val(data_row.failover);
        $('#record-type').val(data_row.type);
        $('#operation').val("Edit");
        $('.btn-remove-record').show();
        $('.modal-title').text("Edit Record");
    })

    var logsDataTable = $('#logs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "../app/modules/logs/get-logs.php",
            method: "POST"
        },
        responsive: true,
        columns: [
            {
                "data": "id"
            },
            {
                "data": "table_name"
            },
            {
                "data": "request_method"
            },
            {
                "data": "data"
            },
            {
                "data": "recorded_on"
            },
            {
                "data": "button"
            },
        ],
    });

    $('#btn-sync-all').click(function () {
        $.ajax({
            url: "../app/shared/services/syncall.php",
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.res == true) {
                    $(".status-web-api").text("Operational");
                    $("#last-refreshed").html(data.time);
                    $(".acc-count").html(data.acc_count);
                    $(".domain-count").html(data.dom_count);
                    $(".dns-records-count").html(data.dns_count);
                    swal("Success", data.msg, "success");
                } else {
                    $(".status-web-api").text("Not Operational");
                    swal("Error", data.msg, "error");
                }
            }
        });
    });

    function syncAllData() {
        $.ajax({
            url: "../app/shared/services/syncall.php",
            method: "GET",
            dataType: "JSON",
            beforeSend: function () {
                $('.sync-btn').html('<i class="fa fa-refresh fa-spin"></i>&nbsp;Loading');
            },
            success: function (data) {
                if (data.res == true) {
                    $(".counters").html(data.acc_count);
                    $(".status-web-api").text("Operational");
                    $("#last-refreshed").html(data.time);
                    $(".last-refreshed").html(data.time);
                    $(".acc-count").html(data.acc_count);
                    $(".domain-count").html(data.dom_count);
                    $(".dns-records-count").html(data.dns_count);
                    syncDomains().done(function (data) {
                        if (data.res = true) {
                            syncDnsRecords().done(function (records) {
                                if (records.res == true) {
                                    $('.sync-btn').html('Sync All Data');
                                    swal("Success", "Data successfully synced.", "success");
                                }
                            })
                        }
                    })
                } else {
                    $(".status-web-api").text("Not Operational");
                    swal("Error", data.msg, "error");
                }
            }
        });
    }

    function syncDomains() {
        return $.ajax({
            url: "../app/shared/services/syncdomains.php",
            method: "GET",
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-sync-domain').html('<i class="fa fa-refresh fa-spin"></i>&nbsp;Loading');
            },
            success: function (data) {
                return data;
            }
        });
    }

    function syncDnsRecords() {
        return $.ajax({
            url: "../app/shared/services/syncdnsrecords.php",
            method: "GET",
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-sync-dnsrecord').html('<i class="fa fa-refresh fa-spin"></i>&nbsp;Loading');
            },
            success: function (data) {
                return data;
            }
        });
    }

    async function checkOnlineStatus() {
        $.ajax({
            url: "../app/shared/services/checknetwork.php",
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.res == true) {
                    $('.net-checker').html("Server Status: Online")
                } else {
                    $('.net-checker').html("Server Status: Offline")
                }
            }
        });
    }

    $('#btn-dns-rec-modal').click(function () {
        $('#dnsrecordsForm')[0].reset();
        $('.modal-title').text("Add Record");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#dns-record-id').prop('readonly', false);
        $('.btn-remove-record').hide();
    });

    $(document).on('submit', '#dnsrecordsForm', function (event) {
        event.preventDefault();
        $.ajax({
            url: "../app/modules/dnsrecords/create-or-update.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                var res = JSON.parse(data);
                if (res.res == true) {
                    swal("Success", res.msg, "success");
                    $('#dnsrecordsForm')[0].reset();
                    $('#dnsRecModal').modal('hide');
                    dnsTable.ajax.reload();
                } else {
                    swal("Error", res.msg, "error");
                    dnsTable.ajax.reload();
                    $('#dnsrecordsForm')[0].reset();
                    $('#dnsRecModal').modal('hide');
                }
            }
        });
    });


    $(document).on('click', '.btn-remove-record', function () {
        var id = $("#dns-record-id").val();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this account",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "../app/modules/dnsrecords/delete.php",
                    method: "POST",
                    data: { id: id, action: 'delete' },
                    success: function (data) {
                        var res = JSON.parse(data);
                        if (res.res == true) {
                            swal("Success", res.msg, "success");
                            $('#dnsrecordsForm')[0].reset();
                            $('#dnsRecModal').modal('hide');
                        } else {
                            swal("Canceled", res.msg, "info");
                            $('#dnsrecordsForm')[0].reset();
                            $('#dnsRecModal').modal('hide');
                        }
                        dnsTable.ajax.reload();
                    }
                })
            } else {
                swal("Cancelled", "Record not removed", "error");
            }
        })
    });

    $('#logs-table').on('click', 'tbody .view-log', function () {
        var data_row = logsDataTable.row($(this).closest('tr')).data();
        $.ajax({
            url: "../app/modules/logs/fetch.php",
            method: "POST",
            data: { id: data_row.id },
            success: function (data) {
                var res = JSON.parse(data)
                $('#logsModal').modal('show');
                $('#log-id').val(res.id);
                $('#data').val(res.data);
                $('#recorded_on').val(res.recorded_on);
                $('#request_method').val(res.request_method);
                $('#table_name').val(res.table_name);
                $('.modal-title').text('Log Id: ' + res.id);
            }
        })
    })

    $('#btn-sync-domain').click(function () {
        $.ajax({
            url: "../app/shared/services/syncdomains.php",
            method: "GET",
            beforeSend: function () {
                $('#btn-sync-domain').html('<i class="fa fa-refresh fa-spin"></i>&nbsp;Loading');
            },
            success: function (data) {
                var res = JSON.parse(data)
                if (res.res == true) {
                    $('#btn-sync-domain').html('Sync');
                    domainsDataTable.ajax.reload();
                    swal("Success", res.msg, "success");
                } else {
                    $('#btn-sync-domain').html('Sync');
                    domainsDataTable.ajax.reload();
                    swal("Error", res.msg, "error");
                }
            }
        })
    });

    $('#btn-sync-dnsrecord').click(function () {
        $.ajax({
            url: "../app/shared/services/syncdnsrecords.php",
            method: "GET",
            beforeSend: function () {
                $('#btn-sync-dnsrecord').html('<i class="fa fa-refresh fa-spin"></i>&nbsp;Loading');
            },
            success: function (data) {
                var res = JSON.parse(data)
                if (res.res == true) {
                    $('#btn-sync-dnsrecord').html('Sync');
                    dnsTable.ajax.reload();
                    swal("Success", res.msg, "success");
                } else {
                    $('#btn-sync-dnsrecord').html('Sync');
                    dnsTable.ajax.reload();
                    swal("Error", res.msg, "error");
                }
            }
        })
    });

    $("#dd-clear-logs").change(function () {
        var val = this.value;
        if (val == 'Date range') {
            $('#date-picker-log').html('<input type="date" id="dd-from" name="dd-from"></input> &nbsp; <input type="date" id="dd-to" name="dd-to"></input>');
        } else {
            $('#date-picker-log').html('');
        }
    });

    $('#btn-clear-log').click(function () {
        var from = $('#dd-from').val();
        var to = $('#dd-from').val();
        var dd_value = $("#dd-clear-logs").val();
        switch (dd_value) {
            case 'All':
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this logs.",
                    icon: "warning",
                    buttons: [
                        'No, cancel it!',
                        'Yes, I am sure!'
                    ],
                    dangerMode: true,
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "../app/modules/logs/clear-logs.php",
                            method: "POST",
                            data: { case: 'all' },
                            success: function (data) {
                                var res = JSON.parse(data)
                                if (res.res == true) {
                                    logsDataTable.ajax.reload();
                                    swal("Success", res.msg, "success");
                                } else {
                                    logsDataTable.ajax.reload();
                                    swal("Error", res.msg, "error");
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "Record not removed", "error");
                    }
                })
                break;
            case 'For today':
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this logs.",
                    icon: "warning",
                    buttons: [
                        'No, cancel it!',
                        'Yes, I am sure!'
                    ],
                    dangerMode: true,
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "../app/modules/logs/clear-logs.php",
                            method: "POST",
                            data: { case: 'today' },
                            success: function (data) {
                                var res = JSON.parse(data)
                                if (res.res == true) {
                                    logsDataTable.ajax.reload();
                                    swal("Success", res.msg, "success");
                                } else {
                                    logsDataTable.ajax.reload();
                                    swal("Error", res.msg, "error");
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "Record not removed", "error");
                    }
                })
                break;
            case 'Date range':
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this logs.",
                    icon: "warning",
                    buttons: [
                        'No, cancel it!',
                        'Yes, I am sure!'
                    ],
                    dangerMode: true,
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "../app/modules/logs/clear-logs.php",
                            method: "POST",
                            data: { case: 'today', from: from, to: to },
                            success: function (data) {
                                var res = JSON.parse(data)
                                if (res.res == true) {
                                    logsDataTable.ajax.reload();
                                    swal("Success", res.msg, "success");
                                } else {
                                    logsDataTable.ajax.reload();
                                    swal("Error", res.msg, "error");
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "Record not removed", "error");
                    }
                })
                break;
            default:
                break;
        }
    });

    $(document).on('click', '.btn-view-dns-records', function () {
        var id = $(this).attr("id");
        var url = window.location.origin + '/?mod=dns&d_name=' + id;
        window.location.replace(url);
    });

    if (mod == 'dns') {
        // syncDnsRecords().done(function (records) {
        //     if (records.res == true) {
        //         $('#btn-sync-dnsrecord').html('Sync');
        //         dnsTable.ajax.reload();
        //         swal("Success", "Data successfully synced.", "success");
        //     }
        // });
        if (d_name != null) {
            dnsTable.search(d_name).draw();
        }
    }

    $(document).on('click', '.btn-logout', function (e) {
        e.preventDefault();
        var token = localStorage.getItem('auth_token');
        $.ajax({
            url: "../app/shared/services/cleartoken.php",
            method: "POST",
            data: { auth_token: token },
            success: function (data) {
                console.log(data)
            }
        });
        localStorage.clear();
        window.location.href = 'login.php';
  
    });

    function checkToken() {
        var token = localStorage.getItem('auth_token');
        if(token != null) {
            $.ajax({
                url: "../app/shared/services/checktoken.php",
                method: "POST",
                data: { auth_token: token },
                success: function (data) {
                    if (data.success == true) {
                        window.location.href = '/';
                    } else if (data.success == false) {
                        window.location.href = 'login.php'
                    }
                }
            });
        } else {
            window.location.href = 'login.php'
        }
    }
    
})(jQuery);
