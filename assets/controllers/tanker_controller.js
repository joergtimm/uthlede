import { Controller } from '@hotwired/stimulus';


export default class extends Controller {
    static targets = ['rangeInput', 'rangeSlider']


    valuechange(event) {

        setTimeout(() => {

            this.rangeInputTarget.value = this.rangeSliderTarget.value

        }, 1500);


    }
}
