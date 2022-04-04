import {
	createElement,
	Component,
	useRef,
	useCallback,
	useMemo,
	createRef,
	Fragment,
} from "@wordpress/element";
import ColorPickerIris from "./color-picker-iris.js";
import classnames from "classnames";
import { __ } from "@wordpress/i18n";

import { nullifyTransforms } from "../usePopoverMaker";

export const getNoColorPropFor = (option) =>
	option.noColorTransparent ? "transparent" : `CT_CSS_SKIP_RULE`;

const focusOrOpenCustomizerSectionProps = (section) => ({
	target: "_blank",
	href: `${window.rt_localizations ? window.rt_localizations.customizer_url : ""
		}${encodeURIComponent(`[section]=${section}`)}`,
	...(wp && wp.customize && wp.customize.section
		? {
			onClick: (e) => {
				e.preventDefault();
				wp.customize.section(section).expand();
			},
		}
		: {}),
});

const getLeftForEl = (modal, el) => {
	if (!modal) return;
	if (!el) return;

	let style = getComputedStyle(modal);

	let wrapperLeft = parseFloat(style.left);

	el = el.firstElementChild.getBoundingClientRect();

	return {
		"--option-modal-arrow-position": `${el.left + el.width / 2 - wrapperLeft - 6
			}px`,
	};
};

const PickerModal = ({
	containerRef,
	el,
	value,
	picker,
	onChange,
	option,
	style,
	wrapperProps = {},
	inline_modal,
	appendToBody,
}) => {
	const getValueForPicker = useMemo(() => {
		if (value.color === getNoColorPropFor(option)) {
			return { color: "", key: "empty" };
		}

		// if (value.color && value.color.indexOf(getNoColorPropFor(option)) > -1 && picker.inherit) {
		// 	return {
		// 		color: "picker" + picker.inherit,
		// 		key: getComputedStyle(document.documentElement)
		// 			.getPropertyValue(
		// 				picker.inherit.replace(/var\(/, "").replace(/\)/, "")
		// 			)
		// 			.trim()
		// 			.replace(/\s/g, ""),
		// 	};
		// }

		// if (value.color.indexOf("var") > -1) {
		// 	return {
		// 		key: "var" + value.color,
		// 		color: getComputedStyle(document.documentElement)
		// 			.getPropertyValue(value.color.replace(/var\(/, "").replace(/\)/, ""))
		// 			.trim()
		// 			.replace(/\s/g, ""),
		// 	};
		// }

		return { key: "color", color: value.color };
	}, [value, option, picker]);

	const arrowLeft = useMemo(
		() =>
			wrapperProps.ref &&
			wrapperProps.ref.current &&
			el &&
			getLeftForEl(wrapperProps.ref.current, el.current),
		[wrapperProps.ref && wrapperProps.ref.current, el && el.current]
	);

	return (
		<Fragment>
			<div
				tabIndex="0"
				className={classnames(
					`app-color-picker-modal`,
					{
						"app-option-modal": !inline_modal && appendToBody,
					},
					option.modalClassName
				)}
				style={{
					...arrowLeft,
					...(style ? style : {}),
				}}
				{...wrapperProps}
			>

				<ColorPickerIris
					key={getValueForPicker.key}
					onChange={(v) => onChange(v)}
					value={{
						...value,
						color: getValueForPicker.color,
					}}
				/>
			</div>
		</Fragment>
	);
};

export default PickerModal;
