const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(`/api/seller/customer`, {
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

  getCountries({}) {

    return new Promise((resolve, reject) => {
      axios.get(`/api/admin/country`)
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
        axios.get(`/api/seller/customer/${id}`)
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
       if( data.first_name) form.append('first_name', data.first_name);
       if( data.last_name) form.append('last_name', data.last_name);
       if( data.email) form.append('email', data.email);
       if( data.mobile) form.append('mobile', data.mobile);
       if( data.country_id) form.append('country_id', data.country_id);
       if( data.password) form.append('password', data.password);
      axios.post(`/api/seller/customer`, form)
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
       if( data.first_name) form.append('first_name', data.first_name);
       if( data.last_name) form.append('last_name', data.last_name);
       if( data.email) form.append('email', data.email);
       if( data.mobile) form.append('mobile', data.mobile);
       if( data.country_id) form.append('country_id', data.country_id);
       if( data.password) form.append('password', data.password);
       if( data.image) form.append('image', data.image);
      axios.post(`/api/seller/customer/${data.id}`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  saveJSON({}, data) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/seller/customer/store_many`, data)
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
      axios.put(`/api/seller/customer/`, JSON.parse(data))
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
        axios.delete(`/api/seller/customer`, {
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
