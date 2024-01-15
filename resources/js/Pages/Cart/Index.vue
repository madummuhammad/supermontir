
<script>
import Header from '../../components/dashboard/Header.vue';
import Footer from '../../components/dashboard/Footer.vue';
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3'
const page = usePage()
export default {
    props:{
        garage:Object,
        kupon:Object
    },
    watch: {
        listCart: {
            deep: true,
            handler(newValue) {
                this.selectAll = newValue.every((item) => item.check);
    },
},
        },
    setup(props){
        let listCart = ref([])
        let kuponData=ref(props.kupon);
        var kuponError=ref(null);
        const number_format = (number, decimals, decPoint, thousandsSep) => {
            decimals = decimals || 0;
            number = parseFloat(number);

            if (!decPoint || !thousandsSep) {
                decPoint = '.';
                thousandsSep = ',';
            }

            var roundedNumber = Math.round(number * Math.pow(10, decimals)) / Math.pow(10, decimals);
            var formattedNumber = roundedNumber.toLocaleString(undefined, { minimumFractionDigits: decimals, maximumFractionDigits: decimals });

            return formattedNumber;
        }

        const total=ref(0);
        const getCart = () => {
            axios.get('/api/cart/get')
                .then(response => {
                    listCart.value = response.data.data;
                    console.log(listCart.value)

                    listCart.value.forEach((item,index)=>{
                        item.check=false;
                    })
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        var kupon=ref(null);

        const submit = () => {
             const checkedItems = listCart.value.filter(item => item.check);
            checkoutData
                .transform((data) => ({
                    ...{total:total.value},
                    ...{items:checkedItems},
                    ...{kupon:kupon.value},
                    ...data
                }))
                .post(route('checkout.store'), {
                    // onFinish: (response) => {
                    //     console.log(response)
                    //     console.log(page.props.flash)
                    //     modalCheckoutShow.value=false
                    // },
                    onSuccess:(response)=>{
                        modalCheckoutShow.value=false;
                        selectAll.value=false;
                        window.location.href='/user/transaction'
                        getCart();
                    }
                });
        };


        const deleteCart=(item)=>{
            const indexToDelete = listCart.value.findIndex(cartItem => cartItem.id === item.id);

            if (indexToDelete !== -1) {
                listCart.value.splice(indexToDelete, 1);
                axios.post('/api/cart/delete',[item])
                    .then(response => {

                    })
                    .catch(error => {
                        console.error('Error fetching user data:', error);
                    });
            }

        }

        const deleteCheck = () => {
            const itemsToDelete = listCart.value.filter(cartItem => cartItem.check);

            if (itemsToDelete.length > 0) {
                itemsToDelete.forEach(itemToDelete => {
                    const indexToDelete = listCart.value.findIndex(cartItem => cartItem.id === itemToDelete.id);
                    if (indexToDelete !== -1) {
                        listCart.value.splice(indexToDelete, 1);
                    }
                });

                console.log(itemsToDelete)

                axios.post('/api/cart/delete', itemsToDelete )
                    .then(response => {
                    })
                    .catch(error => {
                        console.error('Error deleting checked cart items:', error);
                    });
            }
        };


        const checkoutData=useForm({
            name:'',
            wa:'',
            address:'',
            garage_id:''
        })

        onMounted(()=>{
            getCart();
        })

        const increase = (item) => {
            console.log(item.qty)
            item.qty=item.qty+1
            check();
        }

        const decrease = (item) => {
            if (item.qty > 1) {
                item.qty = item.qty - 1;
            }
            check();
        }
        var selectAll=ref(false);

        const toggleSelectAll=()=>{
            listCart.value.forEach((item) => (item.check = selectAll.value));
            check();
        };

        const check = () => {
            const totalChecked = listCart.value.reduce((total, item) => {
                if (item.check) {
                    return total + (item.qty * item.product.price);
                }
                return total;
            }, 0);

            total.value=totalChecked;
            console.log('Total dari yang dicentang:', totalChecked);
        };

        const modalCheckoutShow=ref(false);

        const showCheckout = () => {
            console.log(kuponData.value)
            if(kupon.value!==null){
                const filterKupon = kuponData.value.filter(item => item.kupon.code === kupon.value && item.status === 'unused');
                if(filterKupon.length==0){
                    kuponError.value='Kupon Tidak Ditemukan'
                    return;
                } else {
                    console.log('filter',filterKupon[0].kupon)
                    total.value=total.value-filterKupon[0].kupon.discount
                    kuponError.value=null;
                }
            }
            // console.log('filter',filterKupon)
            const hasCheckedItems = listCart.value.some(item => item.check);
            if (hasCheckedItems) {
                modalCheckoutShow.value = true;
            } else {
                console.log('Tidak ada item yang dicentang. Modal tetap tidak ditampilkan.');
            }
        };


        return {
            listCart,
            checkoutData,
            showCheckout,
            modalCheckoutShow,
            deleteCheck,
            getCart,
            total,
            toggleSelectAll,
            increase,
            decrease,
            check,
            submit,
            number_format,
            selectAll,
            page,
            // Kupon
            kupon,
            kuponError,
            kuponData,
            deleteCart
        }
    },
    components: {
        Header,
        Footer,
        Link
    },
}
</script>
<template>
    <Header  :dataFromParent="listCart" />
                <div class="container-fluid  bg-slate-300 pt-5 md:pb-0 pb-24 min-h-screen">
                  <div class="container mx-auto mt-20 md:mt-5">
            <div class="flex justify-center flex-col md:flex-row gap-5">
              <div class="md:w-8/12 w-11/12 mx-auto">
                <div
                  class="bg-white p-6 rounded-lg shadow-md text-center flex justify-center md:flex-row flex-col gap-4 mb-2"
                >
                  <!-- pilih semua -->
                  <div
                    class="w-full text-sm py-4 font-medium text-gray-900 bg-white rounded-lg flex justify-between items-center"
                  >
                    <div class="flex items-center gap-2">
                      <input v-model="selectAll"  @change="toggleSelectAll"
                        type="checkbox"
                        name="pilih_semua"
                        id="pilih_semua"
                        class="border cursor-pointer"
                      />
                      Pilih Semua
                    </div>
                    <div class="flex items-center">
                      <a class="text-red-500 cursor-pointer" @click="deleteCheck">Hapus</a>
                    </div>
                  </div>
                </div>
                <div class="bg-white mb-5 p-6 rounded-lg shadow-md text-center flex justify-center flex-col gap-4">
                  <!-- pilih semua -->
                  <div class="w-full text-sm py-4 font-medium text-gray-900 bg-white rounded-lg flex justify-around items-top" v-for="(item,index) in listCart">
                    <div class="flex items-start md:gap-2 me-2 md:me-0">
                      <input type="checkbox" @change="check" v-model="item.check" name="pilih_semua" id="pilih_semua" class="border cursor-pointer"/>
                      <img :src="item.product.image" class="md:w-28 w-full ms-2" alt="" />
                    </div>
                    <div class="flex flex-col text-left ps-6">
                      <h2 class="text-lg font-semibold text-blue-900">{{item.product.name}}</h2>
                      <p class="text-sm text-gray-500" v-html="item.product.description">
                      </p>
                      <h2 class="text-lg font-semibold text-blue-900">
                        Rp. {{number_format(item.price*item.qty)}}
                      </h2>
                      <!-- counter -->
                      <div class="flex md:justify-start justify-center items-center my-4" >
                        <button @click="decrease(item)" class="bg-white me-2 hover:bg-gray-400 text-blue-900 border-blue-900 border-2 font-bold py-1 px-3 rounded-full" >
                          -
                        </button>
                        <input type="text" value="1" v-model="item.qty" class="w-10 text-center border-0 border-b-2"/>
                        <button class="bg-white ms-2 hover:bg-gray-400 text-blue-900 border-blue-900 border-2 font-bold py-1 px-3 rounded-full" @click="increase(item)">
                          +
                        </button>
                      </div>
                    </div>
                    <div class="flex items-top">
                      <a @click="deleteCart(item)" class="text-red-500 cursor-pointer">
                        <i class="fa-solid fa-trash">
                            <svg fill="red" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                            </i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="md:w-3/12 w-11/12 mx-auto md:pt-9">
                <div
                  class="w-full text-sm py-4 font-medium text-gray-900 bg-white border border-gray-200 rounded-lg mb-4"
                >
                  <p
                    class="w-full px-4 py-2 rounded-t-lg bg-white font-semibold text-[#2F318B]"
                  >
                    Ringkasan Belanja
                  </p>
                  <div class="px-4 py-2 flex justify-between">
                    <p class="text-gray-500 font-bold">Total Harga</p>
                    <p class="font-bold">Rp. {{number_format(total)}}</p>
                  </div>
                  <div class="px-4 py-2">
                    <div class="mb-3">
                        <label for="">Kupon Anda</label>
                        <input type="text" class="w-full mt-2" v-model="kupon">
                        <p class="text-red-700 text-sm text-left">{{ kuponError }}</p>
                    </div>
                    <button class="bg-[#2F318B] w-full py-3 text-white font-semibold rounded-md" @click="showCheckout">Checkout</button>
                     <div class="modal fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50" v-if="modalCheckoutShow">
                <div class="modal-content bg-white mx-auto my-10 p-6 rounded w-1/2">
                    <form @submit.prevent="submit" method="post">
                        <div class="p-3">
                            <p class="text-xl font-bold text-[#2F318B] mb-3 text-center">CHECKOUT</p>
                            <p class="text-yellow-500">*Isi data dibawah ini sebelum melanjutkan</p>
                        </div>
                        <div class="p-3">
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">Nama</div>
                                <div>
                                    <input type="text" name="name" id="name" v-model="checkoutData.name" placeholder="Nama anda..." class="border-2 w-full border-gray-300 rounded-md " >
                                    <p class="text-red-700 text-sm text-left">{{checkoutData.errors.name}}</p>
                                </div>
                        </div>
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">No Telp</div>
                                <div>
                                    <input type="number" name="name" id="name" v-model="checkoutData.wa" placeholder="Telepon/wa Anda..." class="border-2 w-full border-gray-300 rounded-md " >
                                    <p class="text-red-700 text-sm text-left">{{checkoutData.errors.wa}}</p>
                                </div>
                        </div>
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">Alamat</div>
                                <div>
                                    <input type="text" name="name" id="name" v-model="checkoutData.address" placeholder="Alamat lengkap anda..." class="border-2 w-full border-gray-300 rounded-md " >
                                    <p class="text-red-700 text-sm text-left">{{checkoutData.errors.address}}</p>
                                </div>
                        </div>
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left p-0 m-0">Kendaraan</div>
                                <p class="text-xs text-yellow-400 mb-3 p-0">Silahkan isi kendaraan di profile</p>
                                <div>
                                    <select name="vehicle" id="" v-model="checkoutData.garage_id" class="border-2 w-full border-gray-300 rounded-md ">
                                        <option value="">Pilih Kendaraan</option>
                                        <option :value="item.id" v-for="(item,index) in garage">{{ item.merk }} - {{ item.plat }}</option>
                                    </select>
                                    <p class="text-red-700 text-sm text-left">{{ checkoutData.errors.garage_id }}</p>
                                </div>
                        </div>

                        </div>
                    <div class="flex justify-between">
                        <button @click="modalCheckoutShow = !modalCheckoutShow" class="px-4 py-2 text-white w-full mx-3 text-center rounded-md bg-gray-500 ">
                      Batal
                     </button>
                        <button class="px-4 py-2 text-white w-full mx-3 rounded-md bg-[#2F318B] text-center"  :class="{ 'opacity-50': checkoutData.processing }" :disabled="checkoutData.processing">
                       Lanjutkan
                     </button>
                    </div>
                </form>
                </div>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <Footer/>
</template>
