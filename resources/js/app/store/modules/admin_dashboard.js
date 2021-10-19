const actions = {
  getData({}) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/admin/dashboard`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  
}
export default {
  namespaced: true,
  actions,
}
