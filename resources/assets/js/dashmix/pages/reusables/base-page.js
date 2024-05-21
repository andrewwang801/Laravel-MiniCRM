export class BasePage {
    constructor() {

        this.initAjaxWithCsrf();
        // profile edit modal
    }

    initAjaxWithCsrf() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

}
