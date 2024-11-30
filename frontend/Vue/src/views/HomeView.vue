<template>
  <main>
    <header>
      <h1>PR UD 2</h1>
    </header>
    <section>
      <div class="container">
        <!-- CSV Box -->
        <div class="box">
          <h2>CSV</h2>
          <input v-model="filename" type="text" placeholder="Enter filename" />
          <textarea v-model="inputData" placeholder="Enter content"></textarea>
          <button @click="getCsvFiles">Get Files (CSV)</button>
          <button @click="storeCsvFile">Store (CSV)</button>
          <button @click="showCsvFile">Show (CSV)</button>
          <button @click="updateCsvFile">Update (CSV)</button>
          <button @click="deleteCsvFile">Delete (CSV)</button>
        </div>

        <!-- JSON Box -->
        <div class="box">
          <h2>JSON</h2>
          <input v-model="filename" type="text" placeholder="Enter filename" />
          <textarea v-model="inputData" placeholder="Enter content"></textarea>
          <button @click="getJsonFiles">Get Files (JSON)</button>
          <button @click="storeJsonFile">Store (JSON)</button>
          <button @click="showJsonFile">Show (JSON)</button>
          <button @click="updateJsonFile">Update (JSON)</button>
          <button @click="deleteJsonFile">Delete (JSON)</button>
        </div>

        <!-- Class Storage Box -->
        <div class="box">
          <h2>Class Storage</h2>
          <input v-model="filename" type="text" placeholder="Enter filename" />
          <textarea v-model="inputData" placeholder="Enter content"></textarea>
          <button @click="getClassStorageFiles">Get Files (Hello)</button>
          <button @click="storeClassStorageFile">Store (Hello)</button>
          <button @click="showClassStorageFile">Show (Hello)</button>
          <button @click="updateClassStorageFile">Update (Hello)</button>
          <button @click="deleteClassStorageFile">Delete (Hello)</button>
        </div>
      </div>
      <textarea readonly>{{ JSON.stringify(response, null, 2) }}</textarea>
    </section>
  </main>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const filename = ref("");
const inputData = ref("");
const response = ref({});

// CSV Operations
const getCsvFiles = async () => {
  try {
    const res = await axios.get("http://localhost:8000/api/csv");
    response.value = res.data;
  } catch (error) {
    console.error("Error getting CSV files:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not get files" };
  }
};

const storeCsvFile = async () => {
  if (!filename.value || !inputData.value) {
    response.value = { error: "Filename and content are required" };
    return;
  }

  try {
    const res = await axios.post("http://localhost:8000/api/csv", {
      filename: filename.value,
      content: inputData.value,
    });
    response.value = res.data;
    await getCsvFiles(); // Actualiza la lista de archivos almacenados.
  } catch (error) {
    console.error("Error storing CSV file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not store file" };
  }
};


const showCsvFile = async () => {
  if (!filename.value) {
    response.value = { error: "Filename is required" };
    return;
  }

  try {
    const res = await axios.get(`http://localhost:8000/api/csv/${filename.value}`);
    response.value = res.data;
  } catch (error) {
    console.error("Error showing CSV file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not show file" };
  }
};

const updateCsvFile = async () => {
  if (!filename.value || !inputData.value) {
    response.value = { error: "Filename and content are required" };
    return;
  }

  try {
    const res = await axios.put(`http://localhost:8000/api/csv/${filename.value}`, {
      content: inputData.value
    });
    response.value = res.data;
  } catch (error) {
    console.error("Error updating CSV file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not update file" };
  }
};

const deleteCsvFile = async () => {
  if (!filename.value) {
    response.value = { error: "Filename is required" };
    return;
  }

  try {
    const res = await axios.delete(`http://localhost:8000/api/csv/${filename.value}`);
    response.value = res.data;
    await getCsvFiles();
  } catch (error) {
    console.error("Error deleting CSV file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not delete file" };
  }
};

// JSON Operations
const getJsonFiles = async () => {
  try {
    const res = await axios.get("http://localhost:8000/api/json");
    response.value = res.data;
  } catch (error) {
    console.error("Error getting JSON files:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not get files" };
  }
};

const storeJsonFile = async () => {
  if (!filename.value || !inputData.value) {
    response.value = { error: "Filename and content are required" };
    return;
  }

  try {
    const res = await axios.post("http://localhost:8000/api/json", {
      filename: filename.value,
      content: inputData.value
    });
    response.value = res.data;
    await getJsonFiles();
  } catch (error) {
    console.error("Error storing JSON file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not store file" };
  }
};

const showJsonFile = async () => {
  if (!filename.value) {
    response.value = { error: "Filename is required" };
    return;
  }

  try {
    const res = await axios.get(`http://localhost:8000/api/json/${filename.value}`);
    response.value = res.data;
  } catch (error) {
    console.error("Error showing JSON file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not show file" };
  }
};

const updateJsonFile = async () => {
  if (!filename.value || !inputData.value) {
    response.value = { error: "Filename and content are required" };
    return;
  }

  try {
    const res = await axios.put(`http://localhost:8000/api/json/${filename.value}`, {
      content: inputData.value
    });
    response.value = res.data;
  } catch (error) {
    console.error("Error updating JSON file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not update file" };
  }
};

const deleteJsonFile = async () => {
  if (!filename.value) {
    response.value = { error: "Filename is required" };
    return;
  }

  try {
    const res = await axios.delete(`http://localhost:8000/api/json/${filename.value}`);
    response.value = res.data;
    await getJsonFiles();
  } catch (error) {
    console.error("Error deleting JSON file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not delete file" };
  }
};

// Class Storage Operations
const getClassStorageFiles = async () => {
  try {
    const res = await axios.get("http://localhost:8000/api/hello");
    response.value = res.data;
  } catch (error) {
    console.error("Error getting Class Storage files:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not get files" };
  }
};

const storeClassStorageFile = async () => {
  if (!filename.value || !inputData.value) {
    response.value = { error: "Filename and content are required" };
    return;
  }

  try {
    const res = await axios.post("http://localhost:8000/api/hello", {
      filename: filename.value,
      content: inputData.value
    });
    response.value = res.data;
    await getClassStorageFiles();
  } catch (error) {
    console.error("Error storing Class Storage file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not store file" };
  }
};

const showClassStorageFile = async () => {
  if (!filename.value) {
    response.value = { error: "Filename is required" };
    return;
  }

  try {
    const res = await axios.get(`http://localhost:8000/api/hello/${filename.value}`);
    response.value = res.data;
  } catch (error) {
    console.error("Error showing Class Storage file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not show file" };
  }
};

const updateClassStorageFile = async () => {
  if (!filename.value || !inputData.value) {
    response.value = { error: "Filename and content are required" };
    return;
  }

  try {
    const res = await axios.put(`http://localhost:8000/api/hello/${filename.value}`, {
      content: inputData.value
    });
    response.value = res.data;
  } catch (error) {
    console.error("Error updating Class Storage file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not update file" };
  }
};

const deleteClassStorageFile = async () => {
  if (!filename.value) {
    response.value = { error: "Filename is required" };
    return;
  }

  try {
    const res = await axios.delete(`http://localhost:8000/api/hello/${filename.value}`);
    response.value = res.data;
    await getClassStorageFiles();
  } catch (error) {
    console.error("Error deleting Class Storage file:", error);
    response.value = { error: error.response?.data?.mensaje || "Could not delete file" };
  }
};
</script>
<style scoped>
main {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: Arial, sans-serif;
  padding: 2rem;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  background-color: #fff0f5;
}

header h1 {
  margin-bottom: 2rem;
  text-align: center;
  color: #db7093;
  font-size: 2.5rem;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

section {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  width: 100%;
}

.container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  gap: 2rem;
  width: 100%;
}

.box {
  flex: 1;
  border: 1px solid #ffc0cb;
  border-radius: 12px;
  padding: 1.5rem;
  background-color: #ffffff;
  box-shadow: 0 4px 12px rgba(219, 112, 147, 0.15);
  transition: transform 0.2s ease;
}

.box:hover {
  transform: translateY(-5px);
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
  color: #c71585;
  text-align: center;
  font-weight: bold;
}

input, textarea {
  width: 100%;
  padding: 0.75rem;
  margin-bottom: 1rem;
  border: 2px solid #ffb6c1;
  border-radius: 8px;
  font-size: 0.9rem;
  transition: border-color 0.2s ease;
}

input:focus, textarea:focus {
  outline: none;
  border-color: #db7093;
  box-shadow: 0 0 0 3px rgba(219, 112, 147, 0.1);
}

textarea {
  min-height: 120px;
  resize: vertical;
}

button {
  width: 100%;
  padding: 0.75rem;
  margin-bottom: 0.75rem;
  border: none;
  background-color: #db7093;
  color: white;
  cursor: pointer;
  border-radius: 8px;
  font-size: 0.9rem;
  transition: all 0.2s ease;
  font-weight: 500;
}

button:hover {
  background-color: #c71585;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(219, 112, 147, 0.2);
}

button:active {
  transform: translateY(0);
}

textarea[readonly] {
  width: 100%;
  height: 200px;
  margin-top: 1rem;
  background-color: #fff0f5;
  border: 2px solid #ffb6c1;
  border-radius: 8px;
  font-family: monospace;
}

@media (max-width: 1024px) {
  .container {
    flex-direction: column;
  }
  
  .box {
    width: 100%;
  }
}
</style>