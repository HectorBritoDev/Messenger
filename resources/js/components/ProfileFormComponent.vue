<template>
  <b-container class="m-3">
    <b-card :title="'Perfil de '+ user.name">
      <b-form @submit.prevent="onSubmit" id="form">
        <b-form-group label="Correo electrónico:">
          <b-form-input type="text" disabled v-model="user.email"></b-form-input>
        </b-form-group>

        <b-form-group>
          <label for="userName">Nombre</label>
          <b-form-input
            placeholder="Ingresa tu nombre"
            :state="nameValidation"
            v-model="user.name"
            id="userName"
          ></b-form-input>
          <b-form-invalid-feedback :state="nameValidation">Debes ingresar un nombre</b-form-invalid-feedback>
          <b-form-valid-feedback :state="nameValidation"></b-form-valid-feedback>
        </b-form-group>

        <b-form-group label="Nueva contraseña(opcional):">
          <b-form-input
            type="password"
            v-model="newPassword"
            placeholer="Ingrese nueva contraseña"
            :state="passwordValidation"
          ></b-form-input>
          <b-form-invalid-feedback :state="passwordValidation">Debes ingresar una contraseña</b-form-invalid-feedback>
          <b-form-valid-feedback :state="passwordValidation"></b-form-valid-feedback>
        </b-form-group>

        <b-form-group label="Confirmar nueva contraseña:" v-if="newPassword.length > 0">
          <b-form-input
            type="password"
            v-model="newPasswordConfirmation"
            :state="passwordConfirmationValidation"
            placeholder="Reingrese la contraseña"
          >
            <b-form-invalid-feedback
              :state="passwordConfirmationValidation"
            >Las contraseñas no coinciden</b-form-invalid-feedback>
            <b-form-valid-feedback :state="passwordConfirmationValidation"></b-form-valid-feedback>
          </b-form-input>
        </b-form-group>

        <b-form-group label="Imagen de perfil (opcional):">
          <b-img
            :src="actualPicture"
            title="Imagen Actual"
            rounded="circle"
            width="100"
            height="100"
            alt="img"
            class="p-1"
            center
          ></b-img>
          <b-form-file
            id="pictureFile"
            v-model="picture"
            accept="image/jpeg, image/png"
            placehoder="Selecciona o arrastra tu imagen hasta aquí"
            drop-placeholder="Sueltalo aquí"
          ></b-form-file>
        </b-form-group>
        <div slot="footer" class="text-center">
          <b-button type="submit" variant="primary">Aceptar</b-button>
        </div>
      </b-form>
    </b-card>
  </b-container>
</template>

</template>

<script>
export default {
  props: {
    user: Object
  },
  data() {
    return {
      newPassword: "",
      newPasswordConfirmation: "",
      picture: null,
      updatedPicture: ""
    };
  },
  computed: {
    nameValidation() {
      return this.user.name.length >= 0;
    },
    passwordValidation() {
      return this.newPassword.length >= 6 || this.newPassword.length == 0;
    },
    passwordConfirmationValidation() {
      return this.newPassword == this.newPasswordConfirmation;
    },
    actualPicture() {
      return (
        "/users/" +
        (this.updatedPicture ? this.updatedPicture : this.user.avatar)
      );
    }
  },
  methods: {
    onSubmit() {
      const params = {
        name: this.user.name,
        password: this.newPassword,
        password_confirmation: this.newPasswordConfirmation,
        picture: this.picture
      };
      let form = new FormData(document.querySelector("#form"));
      form.append("name", this.user.name);
      form.append("password", this.newPassword);
      form.append("password_confirmation", this.newPasswordConfirmation);
      form.append("picture", this.picture);
      form.append("_method", "PUT");

      //console.log(form.values());
      axios
        .post("/user", form)
        .then(response => {
          alert("Actualizado correctamente");
          this.newPassword = "";
          this.newPasswordConfirmation = "";
          this.updatedPicture = response.data.avatar;
        })
        .catch(error => {
          alert("error");
          console.log(error);
        });
    }

    // handlePicture(event) {
    //   this.picture = event.target.files[0];
    //   console.log(this.picture);
    // }
  }
};
</script>

<style>
</style>
