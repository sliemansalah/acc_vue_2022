let actions = {

    getAll({ }, request) {
        return new Promise((resolve, reject) => {
            window.axios
                .get(`divisions`)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    show({ }, params) {
        return new Promise((resolve, reject) => {
            window.axios
                .get(`${params.api}/${params.id}`)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    save({ }, params) {
        return new Promise((resolve, reject) => {
            window.axios
                .post(`${params.api}`, params.inputs)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    delete({ }, params) {
        console.log(params);
        return new Promise((resolve, reject) => {
            window.axios
                .delete(`${params.api}`, params.id)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

}
export default {
    namespaced: true,
    actions: actions,
}
