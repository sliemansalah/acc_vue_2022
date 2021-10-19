const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/admin/admin_contact`, {
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
  
  findData({}, id) {
    return new Promise((resolve, reject) => {
        axios.get(window.server_url + `/api/seller/contact/${id}`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  saveData({}, data) {
    return new Promise((resolve, reject) => {
       let form = new FormData();
       if( data.name) form.append('name', data.name);
       if( data.email) form.append('email', data.email);
       if( data.message) form.append('message', data.message);
       for(let index=0; index<data.attachments.length;index++) {
        form.append(`attachments[${index}]`, data.attachments[index])
       }
      axios.post(window.server_url + `/api/seller/contact`, form)
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
       if( data.customer_id) form.append('customer_id', data.customer_id);
       if( data.store_id) form.append('store_id', data.store_id);
       if( data.item_id) form.append('item_id', data.item_id);
       if( data.rating) form.append('rating', data.rating);
       if( data.comment) form.append('comment', data.comment);
      axios.post(window.server_url + `/api/seller/contact/${data.id}`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateStatus({}, data) {
    return new Promise((resolve, reject) => {
      axios.put(window.server_url + `/api/seller/contact`, JSON.parse(data))
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  removeData({}, id) {
    return new Promise((resolve, reject) => {
        axios.delete(window.server_url + `/api/admin/admin_contact`, {
            data: {
                ids: id
            }
        })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  }
  
}
export default {
  namespaced: true,
  actions,
}
