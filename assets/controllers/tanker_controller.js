import { Controller } from 'stimulus';
import Axios from "axios";

export default class extends Controller {


    connect() {
        Axios.get(`https://creativecommons.tankerkoenig.de/json/prices.php?ids=3704135c-0d7e-4c76-8346-882f1b60209c&apikey=a2ad9604-4f9f-0021-5fb3-e8e150cb670b`)
            .then(function (res) {
                console.log(res.data.prices)
            })
    }


}
