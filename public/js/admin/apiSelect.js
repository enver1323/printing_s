class APISelect {
    constructor(domElement, apiUrl) {
        this.domElement = domElement;
        this.apiUrl = apiUrl;

        this.initSelect();
    }

    initSelect() {
        $(this.domElement).select2({
            ajax: {
                url: this.apiUrl,
                dataType: 'json',
                data: function (params) {
                    return {name: params.term};
                },
                processResults: function (data) {
                    data = $.map(data.data, function (item) {
                        return {
                            'id': item.id,
                            'text': item.name,
                        }
                    });
                    return {
                        results: data
                    };
                }
            }
        });
    }
}
