import { Controller } from 'stimulus';
import Sortable from "sortablejs";
import axios from "axios";

export default class extends Controller {
    static targets = ['handle'];
    static values = {
        sortUrl: String,
    }

    connect() {
        this.sortable = Sortable.create(this.element, {
            handle: '.drag-handle',
            onEnd: this.end.bind(this),
            animation: 800
        })
    }

    end(  ) {
        axios({
            method: 'post',
            url: this.sortUrlValue,
            data: JSON.stringify(this.sortable.toArray())
        })
    }

}
