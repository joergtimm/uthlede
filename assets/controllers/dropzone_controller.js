import { Controller } from 'stimulus';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

export default class extends Controller {

    connect() {
        const myDropzone = new Dropzone(this.element);

        myDropzone.on("addedfile", function(file) {
            file.previewElement.addEventListener("click", function() {
                myDropzone.removeFile(file);
            });
        });

        myDropzone.on("sending", function(file, xhr, formData) {
            // Will send the filesize along with the file as POST data.
            formData.append("filesize", file.size);
        });

        myDropzone.on('queuecomplete', () => {
            console.log('queuecomplete');

        })

        myDropzone.on('success', () => {
            console.log('success');

        })
    }

    disconnect() {
        this.element.remove();
    }
}
