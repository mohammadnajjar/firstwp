import { __ } from "@wordpress/i18n";
import { keyboardReturn } from "@wordpress/icons";
const { Fragment } = wp.element;
const { URLPopover, URLInput } = wp.blockEditor;
const { Button, ToggleControl } = wp.components;

const ButtonPopOver = ({
	index,
	url,
	opensInNewTab,
	relNoFollow,
	relSponsored,
	download,
	onChangeProductLinks,
	setSelectedButton,
	buttonNumber,
}) => (
	<Fragment>
		<URLPopover
			onClose={() => {
				setSelectedButton(null);
			}}
			onMouseLeave={() => {
				setSelectedButton(null);
			}}
			className="affx-custom-popover"
		>
			<div
				className={"affiliate-url-input"}
				style={{
					width: "250px",
				}}
			>
				<form
					onSubmit={(event) => {
						event.preventDefault();
						setSelectedButton(null);
					}}
				>
					<URLInput
						placeholder={__(
							"https://www.example.com",
							"affiliatex"
						)}
						className="button-url"
						value={url}
						onChange={(value) => {
							onChangeProductLinks(
								value,
								index,
								`button${buttonNumber}URL`
							);
						}}
						required={false}
						autoFocus={false}
					/>
					<Button
						icon={keyboardReturn}
						label={__("Apply", "affiliatex")}
						type="submit"
					/>
				</form>
				<ToggleControl
					label={__("Open in new tab", "affiliatex")}
					checked={opensInNewTab}
					onChange={(value) => {
						onChangeProductLinks(
							value,
							index,
							`btn${buttonNumber}OpenInNewTab`
						);
					}}
				/>
				<ToggleControl
					label={__('Add rel="nofollow"', "affiliatex")}
					checked={relNoFollow}
					onChange={(value) => {
						onChangeProductLinks(
							value,
							index,
							`btn${buttonNumber}RelNoFollow`
						);
					}}
				/>
				<ToggleControl
					label={__('Add rel="sponsored"', "affiliatex")}
					checked={relSponsored}
					onChange={(value) => {
						onChangeProductLinks(
							value,
							index,
							`btn${buttonNumber}RelSponsored`
						);
					}}
				/>
				<ToggleControl
					label={__("Add download attribute", "affiliatex")}
					checked={download}
					onChange={(value) => {
						onChangeProductLinks(
							value,
							index,
							`btn${buttonNumber}Download`
						);
					}}
				/>
			</div>
		</URLPopover>
	</Fragment>
);

export default ButtonPopOver;
