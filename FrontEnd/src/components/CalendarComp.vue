<template>
  <div class="mb-5 ps-0 border" style="display: flex; overflow-x: scroll">
    <div
      v-for="(dateObj, dateStr) in datesWithAvailableTimes"
      :key="dateStr"
      class="text-center"
    >
      <div class="border fw-bold">{{ dateStr }}</div>
      <div class="d-flex flex-column">
        <div
          v-for="time in dateObj.availableTimes"
          :key="time.value"
          class="p-3 border"
          style="height: 58px; width: 74.04px; position: relative"
        >
          <input
            type="radio"
            :id="time.value + dateObj.dateIndex"
            name="time"
            :value="time.value"
            @change="$emit('time-selected', { time: time.value, day: dateStr })"
          />
          <label :for="time.value + dateObj.dateIndex">{{ time.label }}</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    selectedTime: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      dataFromDatabase: null,
    };
  },
  created() {
    axios
      .get("http://localhost/myvisa/dossier/getTimeDate")
      .then((response) => {
        let data = response.data;

        const outputData = {};

        data.forEach((item) => {
          const date = item.date;
          if (date in outputData) {
            outputData[date].push(item.time);
          } else {
            outputData[date] = [item.time];
          }
        });
        this.dataFromDatabase = outputData;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  computed: {
    datesWithAvailableTimes() {
      const datesObj = {};
      const now = new Date();
      const threeMonthsLater = new Date(
        now.getTime() + 90 * 24 * 60 * 60 * 1000
      );

      let dateIndex = 0;
      for (
        let date = now;
        date <= threeMonthsLater;
        date.setDate(date.getDate() + 1)
      ) {
        if (this.isWeekday(date)) {
          const dateStr = this.formatDate(date);
          let availableTimes = [
            { label: "09:15", value: "09:15" },
            { label: "10:15", value: "10:15" },
            { label: "11:15", value: "11:15" },
            { label: "14:15", value: "14:15" },
            { label: "15:15", value: "15:15" },
          ];
          if (this.dataFromDatabase && dateStr in this.dataFromDatabase) {
            // Filter available times
            availableTimes = availableTimes.filter((time) => {
              return this.dataFromDatabase[dateStr].indexOf(time.value) === -1;
            });
          }
          datesObj[dateStr] = { dateIndex, availableTimes };
          dateIndex++;
        }
      }
      return datesObj;
    },
  },
  methods: {
    formatDate(date) {
      const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      const months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ];
      const dayOfWeek = days[date.getDay()];
      const month = months[date.getMonth()];
      const dayOfMonth = date.getDate().toString().padStart(2, "0");
      return `${dayOfWeek}-${dayOfMonth}-${month}`;
    },
    isWeekday(date) {
      const dayOfWeek = date.getDay();
      return dayOfWeek !== 0 && dayOfWeek !== 6;
    },
  },
};
</script>

<style scoped>
input[type="radio"] {
  display: none;
}
label {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

input[type="radio"]:checked + label {
  background: #2c3e50;
  color: white;
}
</style>
