import { Controller } from 'stimulus';
import { Modal } from 'bootstrap';
import $ from 'jquery';
import { useDispatch } from 'stimulus-use';

export default class extends Controller {
    static targets = ['modal', 'modalBody', 'modalTitel', 'okBtn', 'caclBtn'];
    static values = {
        formUrl: String,
        modalTitel: String,
        modalOk: String,
        modalCancel: String,
    }
    modal = null;

    connect() {
        useDispatch(this);
    }

    async openModal(event) {

        this.caclBtnTarget.innerHTML = this.modalCancelValue;
        this.modalTitelTarget.innerHTML = this.modalTitelValue;
        this.modalBodyTarget.innerHTML = '<i class="fa fa-4x fa-spin fa-spinner"></i>';
        this.modal = new Modal(this.modalTarget);
        this.modal.show();

        this.modalBodyTarget.innerHTML = await $.ajax(this.formUrlValue);
        this.okBtnTarget.innerHTML = this.modalOkValue;
    }

    async submitForm(event) {
        event.preventDefault();
        const $form = $(this.modalBodyTarget).find('form');
        try {
            await $.ajax({
                url: this.formUrlValue,
                method: $form.prop('method'),
                data: $form.serialize(),
            });
            this.modal.hide();
            this.dispatch('success')
        } catch (e) {
            this.modalBodyTarget.innerHTML = e.responseText;
        }
    }

    modalHide() {
        this.modal.hide();
    }

    modalHidden() {
        console.log('it was hidden!');
    }
}
