import './bootstrap';
import 'swiper'
import Swiper from 'swiper';
import 'swiper/css';
import $ from 'jquery'
import 'jquery-mask-plugin'

function mobileInputCreate() {
    $('.mobile_input').mask('+0 (000) 000-00-00');
}
$(document).ready(function () {
    mobileInputCreate()
})

document.addEventListener('DOMContentLoaded', function () {
    window.mobileInputCreate = function () {
        $('.mobile_input').mask('+0 (000) 000-00-00');
    }
})


window.addEventListener('swal:modal', event => {
    Swal.fire({
        title: event.detail.title,
        icon: event.detail.type,
        html: "<p>" + event.detail.text + "</p>",
        showConfirmButton: false,
    })
    if (event.detail.type === 'success') {

        $('#go-to-part-page').attr('href', event.detail.link);
        $('#go-to-part-page').trigger('click');
        $('#back').trigger('click');
    }
})
