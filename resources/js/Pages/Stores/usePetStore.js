import { defineStore } from 'pinia';
import { useToast } from '../../composables/useToast';
const toast = useToast();
export const usePetStore = defineStore("usePetStore",{
    state:() => ({
        typeAction: "list",
        keyList:0,
        pets: [],
        genders: [],
        sizes: [],
        stallions: [],
        madrillas: [],
        disabilitys: [],
        vaccineAndMedicineArray: [],
        trainingArray: [],
        supplementArray: [],
        errors: [],
        formulario:{
            name:null,
            color:null,
            gender_id:null,
            size_id:null,
            race:null,
            birth:null,
            plate:null,
            locker:null,
            stallion_id:null,
            madrilla_id:null,
            disabilitie_id:null,
            Senasa:null,
            atachFile:null,
            observation:null,
        },
    }),
    getters:{},
    actions:{
        async addVacineMedicine() {
            this.vaccineAndMedicineArray.push({
              id: null,
              date: null,
              type: null,
              brand: null,
              dose: null,
              delete: null,
            });
          },
        async deleteVacineMedicine(pos, item) {
            if(item.id){
                let vacineMedicine = this.vaccineAndMedicineArray.find((ele) => ele.id === item.id);
                vacineMedicine.delete = 'delete';
            }else this.vaccineAndMedicineArray.splice(pos,1);
          },
        async addTrainingArray() {
            this.trainingArray.push({
              id: null,
              date: null,
              hour: null,
              type: null,
              state_id: null,
              delete: null,
            });
          },
        async deleteTrainingArray(pos, item) {
            if(item.id){
                let training = this.trainingArray.find((ele) => ele.id === item.id);
                training.delete = 'delete';
            }else this.trainingArray.splice(pos,1);
          },
        async addSupplementArray() {
            this.supplementArray.push({
              id: null,
              concept: null,
              date: null,
              hour: null,
              delete: null,
            });
          },
        async deleteSupplementArray(pos, item) {
            if(item.id){
                let suplement = this.supplementArray.find((ele) => ele.id === item.id);
                suplement.delete = 'delete';
            }else this.supplementArray.splice(pos,1);
          },

          async fetchSave(){
              this.formulario.vaccineAndMedicineArray = this.vaccineAndMedicineArray;
              this.formulario.trainingArray = this.trainingArray;
              this.formulario.supplementArray = this.supplementArray;
              console.log('this.formulario',this.formulario);
            const response = await axios
              .post(route('pets.store'), this.formulario)
              .then(result => {
                if (result.data.code === 200) {
                  toast.toast("Éxito", result.data.message, "success");
                }
                if (result.data.code === 500)
                  toast.toast("Error", result.data.message, "danger");
                if (result.data.status === 422) {

                    const formattedErrors = {};
                    for (const field in result.data.errors) {
                        formattedErrors[field] = result.data.errors[field][0];
                    }
                    this.errors = formattedErrors;

                  toast.toast("Error", result.data.message, "danger");
                  return { error: result.data.errors, status: result.data.status };
                }
                return { status: result.data.code, formedit: result.data.data };
              })
              .catch(async (error) => {
                console.log('datadata', error.response)
                return error.response.status;
              });

            return await response;
          },
          async fetchInfoEdit(id) {
              await axios
                .get(`/pets/edit/${id}`)
                .then(async (result) => {
                  this.formulario = await result.data.data;
                  this.vaccineAndMedicineArray = result.data.data.vaccine_and_medicine
                  this.trainingArray = result.data.data.training
                  this.supplementArray = result.data.data.supplement
                  this.generalData.id = id
                })
                .catch(async (error) => {
                  console.log(await error);
                });
          },
    }
})
