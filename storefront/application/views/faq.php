<!-- titleCover -->
<section class="titleCover" style="background-image: url('<?=site_url('assets/Front/images/faq-bg.webp')?>');">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="TitleTxt">S.S.S.</h2>
			</div>
		</div>
	</div>
</section>
<!-- / titleCover -->


<!-- pageContent -->
<section class="pageContent Faq">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="pageTitle">Sıkça Sorulan Sorular</div>
				<main>
					<?foreach ($faqs as $key => $faqInfo) {?>
					<div class="faqItem">
						<div class="faq_Quistion">
							<h2 class="question"><?=$faqInfo->question?></h2>
						</div>
						<div class="faq_Answer">
							<?=$faqInfo->answer?>
						</div>
					</div>
					<?}?>
				</main>
			</div>
			<!--<div class="col-12">
				<div class="pageTitle">Ödeme Sorunları</div>
				<main>
					<div class="faqItem">
						<div class="faq_Quistion">
							<h2 class="question">1. How can i delete my complaint/comment?</h2>
						</div>
						<div class="faq_Answer">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam temporibus fugiat ea natus adipisci, corrupti, nostrum non eaque deleniti veniam molestias ipsa voluptas blanditiis libero rerum. Magnam dolorum eius praesentium.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam modi unde maxime nam aut, quod et ipsam amet veniam neque repudiandae officiis veritatis hic nisi, quidem excepturi, nemo fugiat illum.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo consectetur et deserunt ab repellendus magni, atque veniam harum, illo, dicta illum. Architecto officiis qui nobis voluptas reiciendis earum, libero eum!</p>
						</div>
					</div>
					<div class="faqItem">
						<div class="faq_Quistion">
							<h2 class="question">2. I have posted a complaint/comment, but it doesn’t appear on the website. Why? When my complaint will be posted?
							</h2>
						</div>
						<div class="faq_Answer">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus consectetur ex debitis minima. At, perferendis? Repudiandae assumenda maxime, quod expedita ab veniam nisi, id, alias deserunt non vitae. Voluptatum, assumenda?</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga incidunt officiis magnam, deleniti accusamus praesentium quis cupiditate doloremque. Fugiat voluptas molestiae voluptatum rem, quidem non ab! Commodi facere natus aliquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti facilis, ad eaque commodi eligendi assumenda doloremque cumque id debitis rerum rem, inventore dignissimos maiores dolores, aliquid fugiat repellendus dicta! Molestias!</p>
						</div>
					</div>
					<div class="faqItem">
						<div class="faq_Quistion">
							<h2 class="question">3. How can I edit a complaint I posted?
							</h2>
						</div>
						<div class="faq_Answer">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, adipisci tempora, eligendi ratione totam voluptate, neque fuga ab, maxime odit perspiciatis. Et consectetur quasi recusandae pariatur sint obcaecati optio. Voluptatibus.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non doloribus magni, consequuntur accusantium debitis, commodi vel ipsum! Necessitatibus qui aspernatur id magni incidunt voluptatibus animi, cum rem, eum earum voluptatum?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, beatae veritatis commodi sunt quas rem ab aliquam consectetur ratione deleniti, vitae iure cupiditate velit unde, tempora debitis alias quidem maiores.</p>
						</div>
					</div>
					<div class="faqItem">
						<div class="faq_Quistion">
							<h2 class="question">4. How can i find out personal information of another user?
							</h2>
						</div>
						<div class="faq_Answer">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima nostrum, ab optio cupiditate voluptatibus, nemo possimus repellat quaerat excepturi, fugit earum corrupti reiciendis dolore obcaecati quae sequi ducimus id tempora.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam dicta recusandae deserunt laborum architecto nemo assumenda iure animi ut vel possimus quas, maiores odit eum amet labore itaque, culpa nesciunt.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit doloribus quo sapiente laudantium, eius vero dolorem ratione officia officiis dolor impedit, incidunt autem earum, sed dolore itaque neque ea. Sint.</p>
						</div>
					</div>
				</main>
			</div>-->
		</div>
	</div>
</section>
<!-- / pageContent -->



