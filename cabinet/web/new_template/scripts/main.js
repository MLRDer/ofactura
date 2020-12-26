$(document).ready(function () {

    //notification-modal
    $('.control-link.notification').on('click', function () {
        $('.notification-modal').addClass('show-modal');
        $('body').addClass('overflow-hidden')
    });
    $('.notification-modal .close').on('click', function () {
        $('.notification-modal').removeClass('show-modal');
        $('body').removeClass('overflow-hidden')
    });

    //header balance animation
    if($('.control-panel .balance').hasClass('fill-score')){
        setInterval(function () {
            setTimeout(function () {
                $('.control-panel .balance').addClass('animation')
            });
            $('.control-panel .balance').removeClass('animation')
        },5000, )
    }

    //checkbox is checked
    $('.input-checkbox').change(function () {
        if($('.checkbox').hasClass('checked')){
            $('.checkbox').removeClass('checked')
        }
        if (this.checked) {
            $(this).parent().addClass('checked');
        }
    });

    //customScrollbar
    $(".my-scroll").customScrollbar({
        skin: "default-skin",
        hScroll: false,
        updateOnWindowResize: true
    });

    // // dynamic table add method and remove method
    // let cloneTableTr = `<tr>
    //                         <td>
    //                             <label class="second-checkbox d-inline-block m-t-5">
    //                                 <input type="checkbox">
    //                                 <div class="square"></div>
    //                             </label>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="table-input">
    //                                 <input type="text" value="0">
    //                             </div>
    //                         </td>
    //                     </tr>`;
    // let smallTableTr = `<tr>
    //                                     <td>
    //                                         <label class="second-checkbox d-inline-block m-t-5">
    //                                             <input type="checkbox">
    //                                             <div class="square"></div>
    //                                         </label>
    //                                     </td>
    //                                     <td>
    //                                         <div class="table-input">
    //                                             <input type="text" value="-">
    //                                         </div>
    //                                     </td>
    //                                     <td>
    //                                         <div class="table-input">
    //                                             <input type="text" value="0">
    //                                         </div>
    //                                     </td>
    //                                     <td>
    //                                         <div class="table-input">
    //                                             <input type="text" value="0">
    //                                         </div>
    //                                     </td>
    //                                 </tr>`;
    // $('.standard-btn, .extra-btn, .reimbursement-expenses, .without-payment, .fixed').on('click', function () {
    //     $(this).parent().parent().find('.body table tbody').append(cloneTableTr);
    // });
    // $('.remove').on('click', function () {
    //     let self = $(this).closest('.table-card-gray').find('.dynamic-table tr td input:checked');
    //     if(self){
    //         self.closest('tr').remove();
    //     }
    // });
    // $('.small-btn').on('click', function () {
    //     $(this).parent().parent().find('.body table tbody').append(smallTableTr);
    // });
    // $('.remove').on('click', function () {
    //     let self = $(this).closest('.small-table').find('.dynamic-table tr td input:checked');
    //     if(self){
    //         self.closest('tr').remove();
    //     }
    // });

    //datepicker
    // $('.my-datepicker').datepicker();
    // $('.my-datepicker').inputmask({separator: "-",mask:"1-2-y",
    //     alias: "yyyy-mm-dd", showMaskOnHover: false, placeholder: '',});
    // $('.datepicker-wrapper').css('z-index',9999999999);
    // $('.datepicker-wrapper, .my-datepicker').focus(this).css('z-index',99999999999);


    $('.show-extra-form-btn').on('click', function () {
        let input = $(this).find('input');
        if(input.is(':checked')){
            $(this).closest('.row').find('.extra-form').addClass('show-extra-form')
        }else{
            $(this).closest('.row').find('.extra-form').removeClass('show-extra-form')
        }
    });

    //select2
    $(".js-example-basic-hide-search").select2({
        minimumResultsForSearch: Infinity
    });

});