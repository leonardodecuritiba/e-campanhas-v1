<script>
    $(document).ready(function(){
        $('a.active').click(function(){
            var $this = $(this);
            $.ajax({
                url: '{{route('ajax.set.active')}}',
                data: {id : $($this).data('id'), model : $($this).data('model')},
                type: 'GET',
                dataType: "json",
                beforeSend: function (xhr, textStatus) {
                    loadingCard('show',$this);
                },
                error: function (xhr, textStatus) {
                    console.log('xhr-error: ' + xhr.responseText);
                    console.log('textStatus-error: ' + textStatus);
                    loadingCard('hide',$this);
                },
                success: function (json) {
                    loadingCard('hide',$this);
                    if(json.status){
                        var message = json.message;
                        var $tr = $($this).parents('tr');
                        $($tr).removeClass().addClass(message.active_row_color);
                        $($tr).find('span').removeClass().addClass('badge badge-' + message.active_color).html(message.active_text);

                        $($this).find('i').removeClass().addClass('ti ti-' + message.active_btn_icon);
                        $($this).removeClass()
                            .addClass('btn btn-square btn-xs btn-outline active btn-' + message.active_btn_color);
                        app.toast(message.active_update_message);

                    }
                }
            });
        })
    })
</script>
