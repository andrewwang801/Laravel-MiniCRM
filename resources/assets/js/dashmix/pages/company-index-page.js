import {BasePage} from "./reusables/base-page";
import {initDatatable} from "./reusables/init-datatable";

export class CompanyIndexPage extends BasePage {

    constructor() {
        super();

        initDatatable();
    }

    // Send delete request to resource controller's destroy function, params: companyId
    deleteCompany(companyId) {

        if (confirm("Do you want delete this company?")) {

            Dashmix.layout('header_loader_on');

            $.ajax({
                url: `${baseUrl}/company/${companyId}`,
                type: "delete",
                success: (response) => {
                    Dashmix.layout('header_loader_off');

                    if (response.message == 'OK') {
                        window.location.reload();
                    }
                }
            });
        }
    }
}
