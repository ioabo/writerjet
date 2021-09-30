<template>
  <form @submit.prevent="submit">
    <h2>Basic data</h2>

    <Text
      name="title"
      label="Position name"
      description="Name the position (eg. Marketing intern, IT fresh graduate program)"
      rules="required"
    />

    <Location
      :conditions="[['default_location', false]]"
      name="location"
      label="Place of work"
      placeholder="Add the exact address of the work"
      provider="google"
      rules="required"
    />

    <Checkbox
      name="default_location"
      :text="`The place of work is the same as in your company profile: <i>${company_address}</i>`"
    />

    <Radiogroup
      name="job_type"
      rules="required"
      appearance="pills"
      :items="['Internship', 'Graduate', 'Voluntary', 'Junior']"
    />

    <Tags
      name="categories"
      label="Job categories"
      rules="required|max:3"
      description="Select up to 3"
      :search="true"
      :items="categories"
    />

    <Slider
      name="work_hours"
      label="Required minimum weekly working hours"
      min="1"
      max="40"
      default="20"
      :format="v => v > 1 ? `${v} hours` : '1 hour'"
    />

    <Group
      name="salary"
      label="payment"
    >
      <Select
        name="has_salary"
        placeholder="Select"
        rules="required"
        :native="false"
        :items="{1: 'Paid', 0: 'Unpaid'}"
        :columns="{lg:4,sm:6}"
      />

      <Text
        name="salary"
        placeholder="Amount"
        rules="integer"
        :columns="{lg:4,sm:6}"
        :conditions="[['salary.has_salary', 1]]"
      />

      <Select
        name="salary_currency"
        default="usd"
        :native="false"
        :items="{usd: 'USD', eur: 'EUR'}"
        :columns="{lg:4,sm:6}"
        :conditions="[['salary.has_salary', 1]]"
      />

      <Select
        name="salary_period"
        default="weekly"
        :native="false"
        :items="{hourly: '/ hour', daily: '/ day', weekly: '/ week', monthly: '/ month'}"
        :columns="{lg:4,sm:6}"
        :conditions="[['salary.has_salary', 1]]"
      />
    </Group>

    <h2>Schedule</h2>

    <Date
      name="application_deadline"
      label="Application deadline"
      rules="required"
      :conditions="[['continuous_application'], false]"
    />

    <Checkbox
      name="continuous_application"
      text="Can apply continuously"
    />

    <Group
      name="job_period"
    >
      <Group
        name="job_start_group"
        columns="6"
      >
        <Date
          name="job_start_date"
          label="Getting started"
          rules="required"
          :conditions="[['job_period.job_start_group.job_start_immediate'], false]"
        />

        <Checkbox
          name="job_start_immediate"
          text="Immediately"
        />
      </Group>

      <Group
        name="job_end_group"
        columns="6"
      >
        <Date
          name="job_end_date"
          label="End of work"
          rules="required"
          :conditions="[['job_period.job_end_group.job_end_indefinite'], false]"
        />

        <Checkbox
          name="job_end_indefinite"
          text="Indefinite"
        />
      </Group>
    </Group>

    <h2>Requirements</h2>

    <List
      name="languages"
      min="1"
    >
      <Object>
        <Select
          name="language_id"
          placeholder="Language"
          rules="required"
          columns="6"
          :search="true"
          :items="languages"
        />

        <Select
          name="language_level"
          placeholder="Level"
          rules="required"
          columns="6"
          :items="{25: 'Beginner', 50: 'Intermediate', 75: 'Advanced', 100: 'Native'}"
        />
      </Object>
    </List>

    <Checkbox
      name="student_status_required"
      label="Student status"
      text="Student status is required for the job"
      :trueValue="1"
      :falseValue="0"
    />

    <Checkbox
      name="degree"
      label="Degree"
      text="Degree is required for work"
      :trueValue="1"
      :falseValue="0"
    />

    <Select
      name="degree_requirement"
      placeholder="Degree level"
      :columns="{lg:5,sm:6}"
      :items="{50: 'BA/BSc', 75: 'MA/MSc', 100: 'PhD'}"
      :conditions="[['degree', 1]]"
    />

    <Tags
      name="professional_skills"
      label="Professional skills"
      description="Choose as many as you can"
      :createTag="true"
      :items="professional_skills"
    />

    <Tags
      name="computer_skills"
      label="Computer skills"
      description="Choose as many as you can"
      :createTag="true"
      :items="computer_skills"
    />

    <Tags
      name="soft_skills"
      label="Soft skills"
      description="Choose as many as you can"
      :createTag="true"
      :items="soft_skills"
    />

    <h2>Job description</h2>

    <Trix
      name="description"
      label="Position description, tasks"
    />

    <Trix
      name="requirements"
      label="Requirements"
    />

    <Trix
      name="offer"
      label="What we offer"
    />

    <h2>How to apply</h2>

    <Radio
      name="internal_application"
      fieldName="application_type"
      text="<b>Recommended</b>: Apply with profile"
      description="Select this if you want to rely on our internal application tracking system"
    />

    <Group
      name="feedback"
      label="Auto reply message for applicants"
      before="Here you can write messages in advance you would like to send out to applicants when you accept or reject their application."
      :conditions="[['internal_application', true]]"
    >
      <FeedbackTypeSelectElement
        :paths="['feedback.accept_feedback', 'feedback.reject_feedback']"
      />

      <Trix
        name="accept_feedback"
        placeholder="Successful application message"
        default="Congratulations! You're application has been accepted. We'll contact you soon."
        rules="required"
      />

      <Trix
        name="reject_feedback"
        placeholder="Unsuccessful application message"
        default="Unfortunately you haven't been selected in round. We wish you the best of luck next time!"
        rules="required"
      />
    </Group>

    <Radio
      name="external_application"
      fieldName="application_type"
      text="Forward candidates to an external site"
      description="Select this if you want to rely on an external application tracking system"
    />

    <Text
      :conditions="[['external_application', true]]"
      name="external_url"
      label="Add link"
      placeholder="eg. https://yourcompany.com/job-title"
      rules="required|url"
    />

    <h2>Pictures and videos</h2>

    <Image
      name="cover"
      label="Cover image"
      description="This is the first image job seekers will see at the top of your ad. Use a high quality image. Recommended image size: 1640x720px (Similar to <a href='https://blog.snappa.com/facebook-cover-photo-size/' target='_blank'>Facebook cover photo</a> size)"
      rules="required|max:5000"
      :auto="false"
      :conditions="[['default_cover'], false]"
    />

    <Checkbox
      name="default_cover"
      text="Use the cover image provided in your company profile"
    />

    <Gallery
      name="gallery"
      label="Image gallery (optional)"
      rules="max:8"
      :sort="true"
      :file="{rules:'required|max:3000'}"
      :auto="false"
    />

    <List
      name="youtubes"
      label="Youtube Video (Optional)"
    >
      <Text
        name="yotube"
        component="YoutubeElement"
        description="Copy your Youtube video <b>ID</b> . Ex: https://www.youtube.com/watch?v= <b>welpvNwbw0E</b>"
        rules="required|size:11"
        :addons="{before:'https://www.youtube.com/watch?v='}"
      />
    </List>

  </form>
</template>

<script>
  import axios from 'axios'
  import { Vueform, useVueform } from 'vueform'
  import FeedbackTypeSelectElement from './../elements/FeedbackTypeSelectElement'
  import YoutubeElement from './../elements/YoutubeElement'

  export default {
    mixins: [Vueform],
    components: {
      FeedbackTypeSelectElement,
      YoutubeElement,
    },
    setup: useVueform,
    data: () => ({
      categories: async () => {
        return await axios.get('/job-categories')
      },
      languages: async () => {
        return await axios.get('/languages')
      },
      professional_skills: async () => {
        return await axios.get('/skills?type=professional')
      },
      computed_skills: async () => {
        return await axios.get('/skills?type=computer')
      },
      job_skills: async () => {
        return await axios.get('/skills?type=job')
      },
    }),
    computed: {
      company_address() {
        return '1600 Amphitheatre Parkway in Mountain View, California, United States'
      }
    },
    mounted() {
      this.on('success', () => {
        console.log(this.filtered)
        alert('Job posted')
        this.reset()
      })
    }
  }
</script>