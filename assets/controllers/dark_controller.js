import { Controller } from 'stimulus';
import {useDispatch} from "stimulus-use";

export default class extends Controller {
    static targets = ['darker']

    initialize() {
        var darkThemeSelected =
            localStorage.getItem("darkSwitch") !== null &&
            localStorage.getItem("darkSwitch") === "dark";
        darkSwitch.checked = darkThemeSelected;
        darkThemeSelected
            ? this.element.setAttribute("data-theme", "dark")
            : this.element.removeAttribute("data-theme");
    }

    connect() {



            this.darkerTarget.addEventListener("change", () => {
                if (this.darkerTarget.checked) {
                    this.element.setAttribute("data-theme", "dark");
                    localStorage.setItem("darkSwitch", "dark");
                } else {
                    this.element.removeAttribute("data-theme");
                    localStorage.removeItem("darkSwitch");
                }
            });

    }



}