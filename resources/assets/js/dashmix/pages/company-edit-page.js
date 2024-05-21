import {BasePage} from "./reusables/base-page";

export class CompanyEditPage extends BasePage {

    constructor() {
        super();

        // Set form validator to edit form, { name : required}
        let editForm = $('#edit-form');
        this.validator = editForm.validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeIn',
            errorElement: 'div',
            errorPlacement: (error, el) => {
                jQuery(el).addClass('is-invalid');
                jQuery(el).parents('.form-group').append(error);
            },
            highlight: (el) => {
                jQuery(el).parents('.form-group').find('.is-invalid').removeClass('is-invalid').addClass('is-invalid');
            },
            success: (el) => {
                jQuery(el).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                jQuery(el).remove();
            },
            rules: {
                'name': {
                    required: true
                },
            },
            messages: {
                'name': {
                    required: 'Please enter a name'
                },

            }
        });
    }
}
