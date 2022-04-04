import { createPortal } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import bezierEasing from "bezier-easing";
import classnames from "classnames";
import { Transition } from "react-spring/renderprops";
import GenericOptionType from "../../GenericOptionType";
import usePopoverMaker from "../../usePopoverMaker";
import Switch from "../ab-switch";

const BoxShadowModal = ({
	option,
	value,
	onChange,
	picker,

	onPickingChange,
	stopTransitioning,

	el,

	hOffsetRef,
	vOffsetRef,
	blurRef,
	spreadRef,

	isTransitioning,
	isPicking,
}) => {
	const { styles, popoverProps } = usePopoverMaker({
		ref: el,
		defaultHeight: !option.hide_shadow_placement ? 507 : 437,
		shouldCalculate:
			isTransitioning === picker.id ||
			(isPicking || "").split(":")[0] === picker.id,
	});

	return (
		(isTransitioning === picker.id ||
			(isPicking || "").split(":")[0] === picker.id) &&
		createPortal(
			<Transition
				items={isPicking}
				onRest={(isOpen) => {
					stopTransitioning();
				}}
				config={{
					duration: 100,
					easing: bezierEasing(0.25, 0.1, 0.25, 1.0),
				}}
				from={
					(isPicking || "").indexOf(":") === -1
						? {
								transform: "scale3d(0.95, 0.95, 1)",
								opacity: 0,
						  }
						: { opacity: 1 }
				}
				enter={
					(isPicking || "").indexOf(":") === -1
						? {
								transform: "scale3d(1, 1, 1)",
								opacity: 1,
						  }
						: {
								opacity: 1,
						  }
				}
				leave={
					(isPicking || "").indexOf(":") === -1
						? {
								transform: "scale3d(0.95, 0.95, 1)",
								opacity: 0,
						  }
						: {
								opacity: 1,
						  }
				}
			>
				{(isPicking) =>
					(isPicking || "").split(":")[0] === picker.id &&
					((props) => (
						<div
							style={{ ...props, ...styles }}
							{...popoverProps}
							className="ct-option-modal ct-box-shadow-modal"
							onClick={(e) => {
								e.preventDefault();
								e.stopPropagation();
							}}
							onMouseDownCapture={(e) => {
								e.nativeEvent.stopImmediatePropagation();
								e.nativeEvent.stopPropagation();
							}}
							onMouseUpCapture={(e) => {
								e.nativeEvent.stopImmediatePropagation();
								e.nativeEvent.stopPropagation();
							}}
						>
							<div className="ct-shadow-trigger">
								<label>
									{__("Enable/Disable", "affiliatex")}
								</label>
								<Switch
									value={value.enable ? "yes" : "no"}
									onChange={() => {
										onChange({
											...value,
											enable: !value.enable,
										});
									}}
								/>
							</div>

							<div className="shadow-sliders">
								<GenericOptionType
									value={value.h_offset}
									values={value}
									id="h_offset"
									option={{
										id: "h_offset",
										label: __(
											"Horizontal Offset",
											"affiliatex"
										),
										type: "ab-slider",
										steps: "half",
										value: option.value.h_offset,
										min: -100,
										max: 100,
										design: "compact",
										ref: hOffsetRef,
										// skipInput: true
									}}
									hasRevertButton={false}
									onChange={(newValue) =>
										onChange({
											...value,
											h_offset: newValue,
										})
									}
								/>

								<GenericOptionType
									value={value.v_offset}
									values={value}
									id="v_offset"
									option={{
										steps: "half",
										id: "v_offset",
										label: __(
											"Vertical Offset",
											"affiliatex"
										),
										type: "ab-slider",
										value: option.value.v_offset,
										min: -100,
										max: 100,
										design: "compact",
										ref: vOffsetRef,
										// skipInput: true
									}}
									hasRevertButton={false}
									onChange={(newValue) =>
										onChange({
											...value,
											v_offset: newValue,
										})
									}
								/>

								<GenericOptionType
									value={value.blur}
									values={value}
									id="blur"
									option={{
										steps: "positive",
										id: "blur",
										label: __("Blur", "affiliatex"),
										type: "ab-slider",
										value: option.value.blur,
										min: 0,
										max: 100,
										design: "compact",
										ref: blurRef,
										// skipInput: true
									}}
									hasRevertButton={false}
									onChange={(newValue) => {
										onChange({
											...value,
											blur: newValue,
										});
									}}
								/>

								<GenericOptionType
									value={value.spread}
									values={value}
									id="spread"
									option={{
										steps: "half",
										id: "spread",
										label: __("Spread", "affiliatex"),
										type: "ab-slider",
										value: option.value.spread,
										min: -100,
										max: 100,
										design: "compact",
										ref: spreadRef,
										// skipInput: true
									}}
									hasRevertButton={false}
									onChange={(newValue) =>
										onChange({
											...value,
											spread: newValue,
										})
									}
								/>
							</div>

							{!option.hide_shadow_placement && (
								<ul className="ct-shadow-style">
									<li
										onClick={() =>
											onChange({
												...value,
												inset: false,
											})
										}
										className={classnames({
											active: !value.inset,
										})}
									>
										Outline
									</li>
									<li
										onClick={() =>
											onChange({
												...value,
												inset: true,
											})
										}
										className={classnames({
											active: value.inset,
										})}
									>
										Inset
									</li>
								</ul>
							)}
						</div>
					))
				}
			</Transition>,
			document.body
		)
	);
};

export default BoxShadowModal;
