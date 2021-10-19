const actions = {
  getActivities({}) {
    return new Promise((resolve, reject) => {
        axios.get(window.server_url + `/api/seller/store/get_activities`)
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
        axios.get(window.server_url + `/api/seller/store/${id}`)
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
      axios.post(window.server_url + `/api/seller/store/${data.id}`, data)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateImage({}, data) {
    return new Promise((resolve, reject) => {
      let form = new FormData();
      if(data.image) form.append('image', data.image);
      axios.post(window.server_url + `/api/seller/store/${data.id}`, form)
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
