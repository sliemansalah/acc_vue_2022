let actions = {

    getAll({}) {
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

    show({ }, id) {
        return new Promise((resolve, reject) => {
            window.axios
                .get(`divisions/${id}`)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    save({ }, data) {
        return new Promise((resolve, reject) => {
            window.axios
                .post(`divisions`, data)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    update({ }, data) {
        return new Promise((resolve, reject) => {
            window.axios
                .put(`divisions/${data.id}`, data)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    remove({ }, id) {
        return new Promise((resolve, reject) => {
            window.axios
                .delete(`divisions/${id}`)
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
