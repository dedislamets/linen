<div id="app">
  <input type="text" v-model:value="message">
  <img v-bind:src="url" v-bind:[caption.attr]="caption.text" />
  <p>Caption diberikan pada atribut <code>{{ caption.attr }}</code> dengan isi "{{ caption.text }}"</p>
  
  <!-- Tutor 2 -->
  <div class="order-detail">
    <p>Ini adalah detail dari pesanan anda: </p>
    <hr>
    <img :src="cover" width="100" />
    <h4>{{ name }}</h4>
    Qty: <input type="number" v-model:value="qty" min="1" max="10" />
    Total: Rp {{ price * qty }}
  </div>
  <hr>
  <label><input type="checkbox" v-model:value="showBonus"> Show Bonus</label>
  <div class="detail" v-if="showBonus">
    <p v-if="qty >= 10">Maaf kamu hanya boleh beli {{ qty }} aja yah.. soalnya kita gak punya banyak stok</p>
    <p v-else-if="qty >= 5">Whoaa tukang borong nih!</p>
    <p v-else-if="qty >= 2">Selamat! Kamu dapat bonus, karena membeli {{ qty }} buku</p>
    <p v-else>Beli liebih banyak lagi untuk dapatkan bonus :)</p>
  </div>

  <!-- Tutor 3 -->
  <h2>Daftar Pekerjaan:</h2>
  <input type="text" placeholder="tambah pekerjaan" v-model:value="newTask" />
  <button @click="addTask" @mouseover="hover = true" @mouseout="hover = false">Add</button>
  <p v-if="hover">Kamu sedang menyentuh tombolnya</p>
  <ul>
      <li v-for="item in todolists">
          <s v-if="item.done">{{ item.task }}</s>
          <b v-else>{{ item.task }}</b>
      </li>
  </ul>

  <!-- Tutor 4 -->
  <input v-on:keyup="getImageData()" v-model="src" type="text" placeholder="https://static.wixstatic.com/media/c9e873_8236ecc5c6a34fa6a0c95e5c38f898c9~mv2.jpeg" />
  <br>
  <textarea rows="8">
    &lt;amp-img
    width=""
    height=""
    alt=""
    src="{{ src }}"
    layout=""&gt;
    &lt;/amp-img&gt;</textarea>
</div>
