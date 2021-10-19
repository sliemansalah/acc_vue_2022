const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/page`, {
        params: queryParams
      })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateData({}, data) {
    return new Promise((resolve, reject) => {
       let form = new FormData();
       if( data.title) form.append('title', data.title);
       if( data.store_id) form.append('store_id', data.store_id);
       if( data.description) form.append('description', data.description);
       if( data.page_type) form.append('page_type', data.page_type);
      axios.post(window.server_url + `/api/seller/page/${data.id}`, form)
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
