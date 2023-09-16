import { mount } from "@vue/test-utils";
import AddPost from "../pages/AddPost.vue";

describe("AddPost.vue", () => {
  it("displays a success message after form submission", async () => {
    const wrapper = mount(AddPost);
    
    // Simulate user input and form submission
    await wrapper.setData({
      newPost: {
        title: "Test Title",
        subtitle: "Test Subtitle",
        content: "Test Content",
        interviewee: "Test Interviewee",
        tags: "tag1, tag2",
        author: "Test Author",
      },
    });
    await wrapper.find("form").trigger("submit.prevent");

    // Wait for the success message to appear
    await wrapper.vm.$nextTick();

    // Assert that the success message is displayed
    expect(wrapper.find(".alert-success").exists()).toBe(true);

    // You can add more assertions here as needed
  });
});