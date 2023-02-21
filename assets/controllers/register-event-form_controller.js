import { Controller } from '@hotwired/stimulus';
import { Modal } from 'bootstrap-modal-js';
import $ from 'jquery'

export default class extends Controller {
    openRegisterModal(event) {
        $("#registerModal").modal()
    }

    closeRegisterModal(event) {
        $("#registerModal").modal('hide');
    }

    saveRegisterForm(event) {
        let modalForm = $("#registerModal");
        console.log(modalForm.data("path_url"));
        const form = $(".form_wrapper").find('form');
        console.log(form.serialize());
        console.log(132);
        $.ajax({
            url: modalForm.data("path_url"),
            method: 'post',
            data: {data: form.serialize()},
        });
        $("#registerModal").modal('hide');
    }

}
