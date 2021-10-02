import Lightbox from "stimulus-lightbox"

export default class extends Lightbox {
    connect() {
        super.connect()
        console.log("Do what you want here.")

        // Default options for every lightboxes.
        this.defaultOptions

        // The lightGallery instance.
        this.lightGallery
    }

    // You can set default options in this getter.
    get defaultOptions () {
        return {
            // Your default options here
        }
    }
}