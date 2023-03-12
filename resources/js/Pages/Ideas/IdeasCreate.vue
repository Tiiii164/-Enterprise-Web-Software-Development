
<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { reactive } from "vue";
import { useRouter } from "vue-router";

export default {
  components: {
    NavBar,
    TheFooter,
  },
  data() {
    return {
      ideas: [],
      user: [],
      topics: [],
      categories: [],
      form: {
        termsAndConditions: false
      },
      showDialog: false,
    }
  },
  setup() {
    const router = useRouter();
    const form = reactive({
      title: '',
      text: '',
      file_path: '',
      categories_id: '',
      topics_id: '',
      user_id: '',
      departments_id: '',
      termsAndConditions: false,
    });
    const handleCreateIdeas = async () => {
      try {
        const response = await axios.post('/api/ideas/IdeasCreate', form)
          .then((res) => {
            router.push('/IdeasIndex')
          })
      } catch (error) {
        console.error(error);
      }
    };
    return {
      form,
      handleCreateIdeas,
    };
  },
  methods: {
    async getCategories() {
      axios.get('/api/categories')
        .then((response) => {
          this.categories = response.data;
        });
      axios.get('/api/topics')
        .then((response) => {
          this.topics = response.data;
        });
    },
    showTermsAndConditions() {
      this.showDialog = true;
    },
    hideTermsAndConditions() {
      this.showDialog = false;
    },
  },
  created() {
    this.getCategories();
  },
}
</script>
<template>
  <NavBar></NavBar>
  <form @submit.prevent="handleCreateIdeas" method="post">
    <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
      <div class="card categoriesindex">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 catecenter">
              <h3>Create new Ideas</h3>
            </div>
            <div class="col-md-6 catecenter">
              <router-link to="/TopicsIndex" class="btn btn-primary catebutton">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 catecenter">
              <div class="form-group">
                <strong>Title</strong>
                <input type="text" name="title" class="form-control" v-model="form.title" placeholder="Enter Title">
              </div>
              <div class="form-group">
                <strong>Text</strong>
                <input type="text" name="text" class="form-control" v-model="form.text" placeholder="Enter Idea">
              </div>
              <div class="form-group">
                <strong>File Path</strong>
                <input type="text" name="file_path" class="form-control" v-model="form.file_path" placeholder="">
              </div>
              <div class="form-group">
                <strong>Category</strong>
                <select class="form-select form-control" v-model="form.categories_id">
                  <option v-for="data in categories" :value="data.id">{{ data.name }}</option>
                </select>
                <strong>Topic</strong>
                <select class="form-select form-control" v-model="form.topics_id">
                  <option v-for="data in topics" :value="data.id">{{ data.name }}</option>
                </select>
              </div>
              <div>
                <div>
                <label>
                  <input type="checkbox" v-model="form.termsAndConditions" @click.stop>
                </label>
                <span style="margin-left:5px">I agree to the </span>
                <span style="text-decoration:underline;cursor:pointer;" @click="showTermsAndConditions">terms and conditions</span>
              </div>
              <div v-if="showDialog" class="dialog-container" style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:100%;height:100%;">
                <!-- Your dialog content here -->
                <div class="card dialog" style="display: flex; flex-direction: column;">
                  <h1 style="text-align:center">Terms and Conditions</h1>
                  <h6>Last updated: 12/03/2023</h6>
                  <h4>Introduction</h4>
                  <p>Welcome to Enterprise Web Software Development! By using our website and/or using the services that are provided, you acknowledge that you have read, understood, and agree to be bound by our Terms and Conditions. These Terms and Conditions unconditionally extend and apply to all related applications, internet service, or website extensions. If you are not in agreement with all of these Terms and Conditions, you are prohibited from using this Website, and you may discontinue use immediately. Enterprise Web Software Development recommends that you save or print a copy of these Terms and Conditions for future reference.</p>
                  <h4>Agreement to Terms and Conditions</h4>
                  <p>Enterprise Web Software Development Terms And Conditions (these "Terms" or these "Terms and Conditions") contained in this Agreement shall govern your use of this Website and all its content (collectively referred to herein as this "Website"). These Terms outline the rules and regulations guiding the use of Enterprise Web Software Development located at [WEBSITE URL]. All materials/information/documents/services or all other entities (collectively referred to as content) that appear on the Enterprise Web Software Development shall be administered subject to these Terms and Conditions. These Terms and Conditions apply in full force and effect to your use of this Website, and the use of this Website constitutes an express agreement with all the terms and conditions contained herein in full. Do not continue to use this Website if you have any objection to any of the Terms and Conditions stated on this page.</p>
                  <h4>Definitions/Terminology</h4>
                  <p>The following definitions apply to these Terms and Conditions, Privacy Statement, Disclaimer Notice and all Agreements: "User", "Visitor," "Client," "Customer," "You" and "Your" refers to you, the person(s) that use this Website. "Enterprise Web Software Development", "We", "Our" and "Us", refers to our Website/Company. "Party," "Parties," or "Us," refers to both you and us. All terms refer to all considerations of Enterprise Web Software Development necessary to undertake support to you for the express purpose of meeting your User needs in respect of our services, under and subject to, prevailing law of the state or country in which [WEBSITE NAME] operates (VietNam). Any use of these definitions or other glossary in the singular, plural, capitalization, and/or pronoun are interchangeable but refer to the same.</p>
                  <h4>Intellectual Property Rights</h4>
                  <p>Other than the content you own and opted to include on this Website, under these Terms, Enterprise Web Software Development and/or its licensors own and reserve all intellectual property rights of this Website. You are granted a limited license, subject to the restrictions entailed in these Terms and Conditions, for purposes of viewing this Website's content.</p>
                  <h4>Services</h4>
                  <p>The content of this Website is not intended for use or distribution to any person or entity in any jurisdiction, geographical location, or country/state where such use or distribution will be contrary to the laws and regulations or subject Enterprise Web Software Development to any form of registration, claims, demands, costs, liabilities, damages, or expenses.</p>
                  <p>The Website is intended for users who are at least 18 years of age. If you are under the age of 18, you cannot use or register to use this Website or its services without parental permission or consent. By agreeing to these Terms and Conditions, you have the necessary legal capacity to comply and be bound by these Terms and Conditions.</p>
                  <h4>Acceptable Use</h4>
                  <p>You may use this Website as permitted by these Terms and Conditions and may not use this Website for any purpose other than for which Enterprise Web Software Development makes the Website and its services available.</p>
                  <h4>Cookies</h4>
                  <p>Enterprise Web Software Development employs the use of cookies. By accessing Our Website, You agree to use cookies in Agreement with our Cookie Policy.</p>
                  <p>Our interactive Website's optimal functionality uses cookies to retrieve the User's information for each visit. Some of our affiliate partners may also use cookies.</p>
                  <h4>License</h4>
                  <p>Unless otherwise stated, Enterprise Web Software Development and/or its licensors own the intellectual property rights for all content on Enterprise Web Software Development. All intellectual property rights are reserved. You may access any Website content from Enterprise Web Software Development for your personal use subject to restrictions set in these terms and conditions.</p>
                  <p>Enterprise Web Software Development hereby restricts you from all of the following:</p>
                  <p>1.Republishing any Enterprise Web Software Development content in any media;</p>
                  <p>2.Reproducing, duplicating, or copying any Enterprise Web Software Development content ;</p>
                  <p>3.Selling, renting, sublicensing, and/or otherwise commercializing any Enterprise Web Software Development content;</p>
                  <p>4.Publicly performing and/or displaying any Enterprise Web Software Development content;</p>
                  <p>5.Using this Website in a manner that is, or maybe, damaging and/or impacts user access to this Website;</p>
                  <p>6.Using this Website contrary to the relevant rules, laws, and regulations of your country of residence, or in a manner that causes, or may cause, harm to the Website, or any person or business entity;</p>
                  <p>7.Conducting data mining or any other similar activity concerning this Website, or while using this Website; and</p>
                  <p>8.Using this Website to engage in any form of business advertising or marketing.</p>
                  <p>Specific areas of this Website may be restricted from user access, and Enterprise Web Software Development may further extend such restriction to the entire Website, at any time, and in its sole discretion. Any user identification, security key, or password you may have on this Website are confidential, and you are responsible for maintaining such information confidentiality.</p>
                  <h4>Linking and Hyperlinking Rights</h4>
                  <p>We reserve the right to file requests that you remove all links or any particular link created by you that redirect to our Website, and you approve to immediately remove such links to our Website upon request. We may amend the terms and conditions of these linking rights at any time. By continuously linking to our Website, you agree to be bound to and follow the terms of this linking policy.</p>
                  <p>Feel free to contact us if you find any link on our Website that is offensive, and we may consider requests to remove such links. Still, we are not obligated to do so or respond to you directly or immediately.</p>
                  <h6>Hyperlinking to our Content</h6>
                  <p>Organizations such as search engines, government agencies, news organizations, and online directories may link to our Website without prior written approval. We may review other link requests from popular consumer and/or information specialists, charity organizations, internet portals, educational institutions, trade associations, and dot.com community sites. Any interested organization must inform and contact us for further information regarding our linking policy. However, such linking does not imply endorsement, sponsorship, partnership, or approval by us of any kind.</p>
                  <p>No use of our logo or other design intellectual property will be allowed for linking, except a trademark license agreement.</p>
                  <h6>Link to third-party content</h6>
                  <p>This Website may contain links to websites or applications operated by third parties. Please know that we do not control any such third-party websites or applications or the third party operator. Enterprise Web Software Development is not responsible for and does not endorse any third-party websites or applications or their availability or content.</p>
                  <p>Enterprise Web Software Development accepts no responsibility for adverts contained within the Website. You agree that you do so at your own risk when you purchase any goods and/or services from any such third party. The advertiser, and not us, remains responsible for such goods and/or services, and if you have any questions or complaints about them, you should contact the advertiser</p>
                  <h4>User Content</h4>
                  <p>In these Website Standard Terms and Conditions, "User Content" shall mean any audio, video, text, images, or other material or content you choose to display on this Website. Concerning user content, by displaying it, you grant Enterprise Web Software Development a non-exclusive, worldwide, irrevocable, royalty-free, sub-licensable license to use, reproduce, adapt, publish, translate and distribute it on any media.</p>
                  <p>User Content must be your own and must not be infringing on any third party's rights. Enterprise Web Software Development reserves the right to remove any of your content from this Website at any time, without notice.</p>
                  <p>Enterprise Web Software Development is permitted to monitor your activities on the Website and remove any user content considered inappropriate, offensive, contrary to applicable laws and regulations, or causes a breach of these Terms and Conditions.</p>
                  <p>You warrant and represent that:</p>
                  <p>1.You are entitled to upload/input/publicize content on our Website and have the necessary legal capacity, license or consent to do so;</p>
                  <p>2.Your content does not infringe any intellectual property right, including without limitation to copyright, patent, or trademark of any third party;</p>
                  <p>3.Your content is true, accurate, current, complete, and relate to you and not a third party;</p>
                  <p>4.Your content does not contain any libelous, defamatory, offensive, immoral, or otherwise illegal material which is an invasion of privacy;</p>
                  <p>5.The content will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</p>
                  <p>You now grant Enterprise Web Software Development a non-exclusive license to use, reproduce, edit and authorize others approved by us to use, reproduce and edit any of your content in any form, format, or media.</p>
                  <h4>Privacy Policy</h4>
                  <p>By using this Website and its services, you may provide us with certain personal information. By using Enterprise Web Software Development or its services, you authorize us to use your information in any country or state that we operate in. We reserve the right to use such information to improve your user experience and facilitate mailing and traffic, and market analytics.</p>
                  <p>By accessing this Website, specific information about the User, such as Internet protocol (IP) addresses, site navigation, user software, and the surfing time, along with other similar information, will be stored on Enterprise Web Software Development servers. Information about their identities, such as name, address, contact details, billing information, and other information stored on this Website, will strictly be used only for statistical purposes and will not be published for general access. Enterprise Web Software Development, however, assumes no responsibility for the security of this information.</p>
                  <h4>Disclaimers/Warranties/Limitation of Liabilities</h4>
                  <p>Enterprise Web Software Development Website is provided "as is," with all liabilities, and Enterprise Web Software Development makes no express or implied undertakings, representations, or warranties, of any kind related to this Website or the content contained on this Website.</p>
                  <p>Enterprise Web Software Development does not make any endorsements, warranties, or representations about the accuracy, reliability, expertise, or completeness of any such content. You agree that reliance on any such content shall be at the User's risk. The Enterprise Web Software Development periodically changes, adds, modifies, improves, or updates this Website's consent with or without prior notice. Under no circumstance shall Enterprise Web Software Development be liable for any loss, damage, injury, liability, or expense incurred or suffered from the use of this Website, including, without limitation, any fault, error, omission, commission, delay, failure, interruption, deletion, alteration, disruption, cessation or incursion concerning such use by us, our affiliates or any third party. Under no circumstance shall Enterprise Web Software Development or any of its partners and affiliates be liable for any direct, indirect, consequential, accidental, or special damages, even if Enterprise Web Software Development has been advised against the risk or possibility of such damages. The User agrees that Enterprise Web Software Development will not be liable for any conduct or behaviour of the User arising from the use of this Website. As a result, the use of this Website and all or any of its content is at the User's sole risk.</p>
                  <p>In no event shall Enterprise Web Software Development, nor any of its officers, directors, employees, and affiliates, be liable for any loss, injury, or damage arising out of your use of this Website, whether, under contract, tort, or otherwise, and Enterprise Web Software Development, including its officers, directors, employees, and affiliates shall not be liable for any indirect, consequential or special liability arising out of your use of this Website.</p>
                  <h4>Indemnification</h4>
                  <p>As a condition for the use of this Website, the User agrees to indemnify Enterprise Web Software Development and its affiliates to the fullest extent, from and against all actions, claims, liabilities, losses, damages, costs, demands, and expenses (including reasonable attorney's fees) arising out of the User's use of this Website, including without limitation, any claim related to the breach of any of the provisions of these Terms and Conditions. If dissatisfied with any or all of the content on this Website or any or all of its Terms and Conditions, the User may discontinue using this Website.</p>
                  <h4>Termination</h4>
                  <p>The provisions of these Terms and Conditions shall remain in full force and effect while you use the Enterprise Web Software Development or its services. Users may terminate their use by following the instructions for terminating user accounts in your account settings or by contacting us at asdasd@gmail.com.</p>
                  <p>We reserve the right and sole discretion to, and without notice or liability, deny access to and use of the Website (including blocking specific IP addresses) to any user for any reason including but not limited to breach of any representation, warranty, or Agreement in these Terms or any applicable law or regulation.</p>
                  <p>We also reserve the right, if, in our sole discretion, we determine that your use of the Website or its services is in breach of these Terms and Conditions or of any applicable law or regulation, to terminate your use of the Website and its services or delete your account and any or all of your content, without warning or prior notice. Suppose we terminate or suspend your account for any reason set out under this section. In that case, you are prohibited from registering and creating a new account under your name, or a false identity, or the expression of a third party. In addition to terminating or suspending your account, Enterprise Web Software Development reserves the right to take appropriate legal action(s), including without limitation pursuing civil, criminal, and injunctive redress.</p>
                  <h4>General Provisions</h4>
                  <h6>Language</h6>
                  <p>All correspondence made under this Agreement shall be in English.</p>
                  <h6>Governing Law & Jurisdiction</h6>
                  <p>The Terms and Conditions of this Website will be governed by and construed under the laws of the country or state in which Enterprise Web Software Development operates. You hereby unconditionally submit to the non-exclusive jurisdiction of the courts located in VietNam for the resolution of any disputes.</p>
                  <h6>Severability</h6>
                  <p>Suppose any of Term or Condition is proven to be unenforceable or void under any applicable law. In that case, such shall not render the entirety of these Terms and Conditions unenforceable or invalid. As a result, any such provision shall be deleted without affecting the remaining provisions herein. The provisions of these Terms and Conditions that are unlawful, void, or unenforceable are deemed severable from these Terms and Conditions and do not affect any remaining provisions' validity and enforceability.</p>
                  <h6>Variation of Terms</h6>
                  <p>Enterprise Web Software Development reserves the right to revise these Terms at any time as it sees fit. By using Enterprise Web Software Development, you are expected to review such Terms regularly to ensure you comprehend all the Terms and Conditions regarding the use of this Website.</p>
                  <h6>Assignment</h6>
                  <p>Enterprise Web Software Development reserves the right to assign, transfer, and subcontract its rights and/or obligations under this Agreement without any prior notification or consent required. Users shall not be permitted to assign, transfer, or subcontract any of your rights and/or obligations under these Terms. Furthermore, a person who is not a party to these Terms and Conditions shall have no right to enforce any provision contained therein.</p>
                  <h6>Preservation of Immunities</h6>
                  <p>Nothing herein shall constitute a limitation upon the privileges and immunities of Enterprise Web Software Development, which are specifically reserved.</p>
                  <h6>Waiver</h6>
                  <p>Our failure to exercise any or all of these Terms and Conditions' provisions at any point in time shall not operate as a waiver of such right or provision.</p>
                  <h6>Entire Agreement</h6>
                  <p>These Terms and Conditions, including any legal notices and disclaimers on this Website, constitute the entire Agreement between Enterprise Web Software Development and you concerning your use of this Website. Ultimately, this Agreement supersedes all prior agreements and understandings concerning the same.</p>
                  <h4>Contact Us</h4>
                  <p>To resolve any complaint or clarification regarding the use of this Website or its services or receive information concerning that, please contact us at asdasd@gmail.com.</p>
                  <div style="justify-content:center;align-items:center;display:flex">
                    <button class="btn btn-primary" style="width:100px;" @click="hideTermsAndConditions">Close</button>
                  </div>
                </div>
              </div>
              </div>
              <button type="submit" class="btn btn-primary mt-2" :disabled="!form.termsAndConditions" @click.prevent="handleCreateIdeas()">Create</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
    </div>
  </form>
  <TheFooter></TheFooter>
</template>