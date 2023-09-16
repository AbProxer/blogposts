
import { config } from "@vue/test-utils";
import Vue from "vue";
import Vuetify from "vuetify"; // Include this if you're using Vuetify

Vue.use(Vuetify); // Include this if you're using Vuetify

config.mocks["$router"] = {
  push: jest.fn(),
};

config.mocks["$route"] = {
  params: {},
};
