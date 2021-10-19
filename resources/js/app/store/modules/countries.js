const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/admin/country`, {
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
  getDataPagination({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/admin/country/getAll`, {
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
        axios.get(window.server_url + `/api/admin/country/${id}`)
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
       if( data.zip_code) form.append('zip_code', data.zip_code);
       if( data.status) form.append('status', data.status);
      axios.post(window.server_url + `/api/admin/country`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateData({}, data) {
    let form = new FormData();
       if( data.image) form.append('image', data.image);
       if( data.name) form.append('name', data.name);
       if( data.zip_code) form.append('zip_code', data.zip_code);
       if( data.status) form.append('status', data.status);
    return new Promise((resolve, reject) => {
      axios.post(window.server_url + `/api/admin/country/${data.id}`, form)
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
      axios.put(window.server_url + `/api/admin/country`, JSON.parse(data))
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
        axios.delete(window.server_url + `/api/admin/country`, {
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
